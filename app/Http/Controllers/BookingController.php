<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use Midtrans\Config; // Tambahkan ini
use Midtrans\Snap;   // Tambahkan ini

class BookingController extends Controller
{
    // 1. Halaman Form Booking (Pilih Kamar)
    public function index(Request $request)
    {
        $rooms = Room::all();

        $bookings = Auth::check()
            ? Booking::where('user_id', Auth::id())->with('room')->get()
            : collect();

        // 🔑 INI KUNCI DROPDOWN
        $selectedRoomId = $request->query('room_id');

        return view('booking', compact(
            'rooms',
            'bookings',
            'selectedRoomId'
        ));
    }
    // 2. Halaman Review Pembayaran (Fix Error: Undefined variable $room)
    public function showPayment($id)
    {
        // Cari kamar berdasarkan ID, jika tidak ada munculkan 404
        $room = Room::findOrFail($id);

        // Kirim variabel $room ke view payment
        return view('front.payment', compact('room'));
    }

    // 3. Proses Mendapatkan Snap Token (Dipanggil oleh AJAX)
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

        // B. Ambil Data Kamar & Hitung Total
        $room = Room::findOrFail($request->room_id);
        
        $checkIn  = new \DateTime($request->check_in);
        $checkOut = new \DateTime($request->check_out);
        $interval = $checkIn->diff($checkOut);
        $days     = $interval->days; // Durasi malam
        
        // Pastikan minimal 1 malam (jika user input hari yg sama, anggap 1 malam)
        $days = $days < 1 ? 1 : $days;

        $totalPrice = $room->price * $days;

        // C. Buat Order ID Unik
        $orderId = 'BOOK-' . time() . '-' . rand(100, 999);

        // D. Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // E. Siapkan Parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone,
            ],
            'item_details' => [
                [
                    'id'       => $room->id,
                    'price'    => $room->price,
                    'quantity' => $days,
                    'name'     => $room->name . ' (' . $days . ' Malam)',
                ]
            ]
        ];

        // F. Request Snap Token dari Midtrans
        try {
            $snapToken = Snap::getSnapToken($params);

            // G. (Opsional) Simpan Booking ke Database dengan status 'Unpaid' di sini jika mau
            // Booking::create([ ... 'status' => 'unpaid', 'snap_token' => $snapToken ... ]);

            // H. RETURN JSON (PENTING UNTUK AJAX)
            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}