<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    // 1. Halaman Form Booking (Pilih Kamar)
    public function index(Request $request)
    {
        $rooms = Room::all();

        $bookings = Auth::check()
            ? Booking::where('user_id', Auth::id())->with('room')->latest()->get()
            : collect();

        // 🔑 INI KUNCI DROPDOWN (Pre-select kamar jika user klik dari halaman home)
        $selectedRoomId = $request->query('room_id');

        return view('booking', compact(
            'rooms',
            'bookings',
            'selectedRoomId'
        ));
    }

    // 2. Halaman Payment (Cek Ketersediaan Sebelum Tampil)
    public function showPayment(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Ambil tanggal dari URL (?check_in=...&check_out=...)
        $checkIn = $request->query('check_in');
        $checkOut = $request->query('check_out');

        // A. Validasi jika tanggal kosong
        if (!$checkIn || !$checkOut) {
            return redirect()->route('booking.index')->with('error', 'Silakan pilih tanggal check-in dan check-out terlebih dahulu.');
        }

        // B. 🛡️ LOGIKA CEK KETERSEDIAAN (Supaya tidak double booking)
        $isBooked = Booking::where('room_id', $id)
            ->whereIn('status', ['pending', 'paid', 'confirmed', 'checked_in'])
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where('check_in', '<', $checkOut)
                    ->where('check_out', '>', $checkIn);
            })
            ->exists();

        // Jika penuh, tendang balik dengan pesan error
        if ($isBooked) {
            return redirect()->route('booking.index')
                ->with('error', 'Maaf, kamar ini SUDAH TERISI pada tanggal tersebut. Silakan pilih tanggal atau kamar lain.');
        }

        // Jika aman, tampilkan halaman payment
        return view('front.payment', compact('room'));
    }

    public function printInvoice($id)
    {
        // Cari booking berdasarkan ID, pastikan user yang login adalah pemiliknya (untuk keamanan)
        $booking = Booking::with('room', 'user')->findOrFail($id);

        // Keamanan sederhana: Cek apakah user ID booking sama dengan user yang login
        if ($booking->user_id != auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('pdf.invoice', compact('booking'));
    }

    // 3. Proses Booking & Request Snap Token Midtrans
    public function process(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_id'   => 'required|exists:rooms,id',
        ]);

        // B. 🛡️ CEK KETERSEDIAAN SEKALI LAGI (PENTING!)
        // Mencegah dua orang menekan tombol bayar di detik yang sama
        $isBooked = Booking::where('room_id', $request->room_id)
            ->whereIn('status', ['pending', 'paid', 'confirmed', 'checked_in'])
            ->where(function ($query) use ($request) {
                $query->where('check_in', '<', $request->check_out)
                    ->where('check_out', '>', $request->check_in);
            })
            ->exists();


        if ($isBooked) {
            // Return JSON Error karena ini dipanggil via AJAX/Fetch
            return response()->json(['message' => 'Kamar baru saja dipesan orang lain. Silakan pilih tanggal lain.'], 422);
        }

        // C. Hitung Durasi & Harga
        $room = Room::findOrFail($request->room_id);

        $checkIn  = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $interval = $checkIn->diff($checkOut);
        $days     = max($interval->days, 1); // Minimal 1 hari

        $totalPrice = $room->price * $days;

        // D. Buat Order ID Unik
        $orderId = 'SUNSET-' . now()->format('YmdHis') . '-' . Str::random(5);

        // E. SIMPAN KE DATABASE
        $booking = Booking::create([
            'order_id'       => $orderId,
            'user_id'        => Auth::id(),
            'room_id'        => $request->room_id,
            'check_in'       => $request->check_in,
            'check_out'      => $request->check_out,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
            'name'           => $request->name,
            'email'          => $request->email,
            'phone'          => $request->phone,
        ]);

        // F. KONFIGURASI MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // G. DATA UNTUK MIDTRANS
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
            'item_details' => [[
                'id' => $room->id,
                'price' => $room->price,
                'quantity' => $days,
                'name' => substr($room->name, 0, 50),
            ]]


        ];



        try {
            // H. Minta Snap Token ke Midtrans
            $snapToken = Snap::getSnapToken($params);

            // I. Update Snap Token ke Database
            $booking->update([
                'snap_token' => $snapToken
            ]);

            // J. Kembalikan ke Frontend (AJAX Response)
            return response()->json([
                'snap_token' => $snapToken,
                'booking_id' => $booking->id
            ]);
        } catch (\Exception $e) {
            // Hapus booking jika gagal connect ke Midtrans agar tidak nyampah
            $booking->delete();
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // API untuk mengambil tanggal yang sudah terisi (dipanggil via AJAX)

public function getBookedDates($roomId)
{
    $bookings = Booking::where('room_id', $roomId)
        ->whereIn('status', ['pending', 'paid', 'confirmed', 'checked_in'])
        ->where('check_out', '>=', now())
        ->get();

    $blockedDates = [];

    foreach ($bookings as $booking) {
        $blockedDates[] = [
            'from' => Carbon::parse($booking->check_in)->format('Y-m-d'),
            'to'   => Carbon::parse($booking->check_out)->subDay()->format('Y-m-d')
        ];
    }

    return response()->json($blockedDates);
}

}
