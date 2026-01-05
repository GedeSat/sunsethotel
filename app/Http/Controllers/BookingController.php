<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use Midtrans\Config; // Tambahkan ini
use Midtrans\Snap;   // Tambahkan ini
use Illuminate\Support\Facades\Log;

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

    public function process(Request $request)
    {
        $request->validate([
            'name'      => 'required|string',
            'email'     => 'required|email',
            'phone'     => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'room_id'   => 'required|exists:rooms,id',
        ]);

        $room = Room::findOrFail($request->room_id);

        $days = max(
            (new \DateTime($request->check_in))
                ->diff(new \DateTime($request->check_out))
                ->days,
            1
        );

        $totalPrice = $room->price * $days;

        $orderId = 'ORD-' . now()->format('YmdHis') . '-' . Str::random(5);

        // SIMPAN BOOKING
      $booking = Booking::create([
    'order_id'       => $orderId,
    'user_id'        => Auth::id(),
    'room_id'        => $request->room_id,
    'check_in'       => $request->check_in,
    'check_out'      => $request->check_out,
    'total_price'    => $totalPrice,
    'payment_status' => 'pending',
    'status'         => 'pending',
]);


        // MIDTRANS
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

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
                'name' => $room->name,
            ]]
        ];

        $snapToken = Snap::getSnapToken($params);

        $booking->update([
            'snap_token' => $snapToken
        ]);

        return response()->json([
            'snap_token' => $snapToken
        ]);
    }
}
