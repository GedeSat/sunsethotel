<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Str;
use App\Models\Booking; // Pastikan Model Booking ada
use Illuminate\Support\Facades\Auth; // Untuk ambil ID user login
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    // 1. HALAMAN FORM PEMBAYARAN (GET)
    public function pay($id)
    {
        $room = Room::find($id);

        if (!$room) {
            abort(404, 'Kamar tidak ditemukan');
        }

        // Pastikan nama file view sesuai lokasi kamu
        return view('payment', compact('room'));
    }

    // 2. PROSES PEMBAYARAN KE MIDTRANS (POST via AJAX)
    public function process(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'room_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        try {
            // B. Hitung Total Harga Real-time (Server Side)
            $room = Room::findOrFail($request->room_id);
            
            $checkIn  = new \DateTime($request->check_in);
            $checkOut = new \DateTime($request->check_out);
            $interval = $checkIn->diff($checkOut);
            $days     = $interval->days; 
            
            if ($days < 1) $days = 1; // Minimal 1 malam
            
            $totalPrice = $days * $room->price;

            // C. Konfigurasi Midtrans
            // Pastikan ini mengambil dari file config/midtrans.php atau .env langsung
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production', false);
            Config::$isSanitized = config('midtrans.is_sanitized', true);
            Config::$is3ds = config('midtrans.is_3ds', true);

            // D. Buat Order ID Unik
            // Format: BOOKING-{TIMESTAMP}-{RANDOM}
            $orderId = 'BOOK-' . time() . '-' . rand(100, 999);

            // E. Siapkan Parameter Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ],
                'item_details' => [
                    [
                        'id' => $room->id,
                        'price' => (int) $room->price,
                        'quantity' => $days,
                        'name' => substr($room->name, 0, 45) . ' (' . $days . ' Malam)', // Nama max 50 char di Midtrans
                    ]
                ]
            ];

            // F. Dapatkan Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // G. SIMPAN KE DATABASE (PENTING!)
            // Kita simpan status 'pending'. Nanti diupdate jadi 'success' via Callback / setelah bayar.
            Booking::create([
                'user_id'     => Auth::id() ?? null, // Simpan ID user jika login
                'room_id'     => $room->id,
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'check_in'    => $request->check_in,
                'check_out'   => $request->check_out,
                'total_price' => $totalPrice,
                'status'      => 'pending',       // Status Awal
                'payment_token' => $orderId,      // Kita simpan Order ID sebagai token pelacak
            ]);

            // H. RETURN JSON (Respon untuk JavaScript)
            // Token ini yang akan membuka Popup Midtrans
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            // Jika ada error (misal koneksi midtrans putus)
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. CALLBACK (Untuk handle notifikasi dari Midtrans)
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $booking = Booking::where('payment_token', $request->order_id)->first();
                if($booking) {
                    $booking->update(['status' => 'success']);
                }
            }
        }
    }
}