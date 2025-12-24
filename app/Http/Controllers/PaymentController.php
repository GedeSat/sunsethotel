<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking; 
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    // 1. HALAMAN VIEW PEMBAYARAN (GET)
    public function pay($id, Request $request)
    {
        $room = Room::find($id);

        if (!$room) {
            abort(404, 'Kamar tidak ditemukan');
        }

        // AMBIL DATA DARI URL (?checkin=...&checkout=...)
        $checkIn  = $request->query('checkin');
        $checkOut = $request->query('checkout');
        
        // Hitung estimasi harga untuk ditampilkan di View
        $days = 0;
        $totalPrice = 0;

        if ($checkIn && $checkOut) {
            try {
                $checkInDate  = new \DateTime($checkIn);
                $checkOutDate = new \DateTime($checkOut);
                $interval     = $checkInDate->diff($checkOutDate);
                $days         = $interval->days;
                if ($days < 1) $days = 1; // Minimal 1 malam
                $totalPrice   = $days * $room->price;
            } catch (\Exception $e) {
                // Abaikan error format tanggal jika user iseng ubah URL
            }
        }

        // Kirim semua data ke View
        return view('payment', compact('room', 'checkIn', 'checkOut', 'days', 'totalPrice'));
    }

    // 2. PROSES PEMBAYARAN KE MIDTRANS (POST via AJAX)
    public function process(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'room_id'   => 'required|exists:rooms,id', // Pastikan ID Room valid di DB
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        try {
            // B. Hitung Total Harga Real-time (Server Side - Lebih Aman)
            $room = Room::findOrFail($request->room_id);
            
            $checkIn  = new \DateTime($request->check_in);
            $checkOut = new \DateTime($request->check_out);
            $interval = $checkIn->diff($checkOut);
            $days     = $interval->days; 
            
            if ($days < 1) $days = 1; 
            
            $totalPrice = $days * $room->price;

            // C. Konfigurasi Midtrans
            Config::$serverKey = config('midtrans.server_key'); // Pastikan config/midtrans.php ada
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // D. Buat Order ID Unik
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
                        'name' => substr($room->name, 0, 45) . ' (' . $days . ' Malam)', 
                    ]
                ]
            ];

            // F. Dapatkan Snap Token
            $snapToken = Snap::getSnapToken($params);

            // G. SIMPAN KE DATABASE
            Booking::create([
                'user_id'     => Auth::id() ?? null,
                'room_id'     => $room->id,
                'name'        => $request->name,
                'email'       => $request->email,
                'phone'       => $request->phone,
                'check_in'    => $request->check_in,
                'check_out'   => $request->check_out,
                'total_price' => $totalPrice,
                'status'      => 'pending',       
                'payment_token' => $orderId,      
            ]);

            // H. RETURN JSON
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // 3. CALLBACK (Wajib Exclude dari CSRF)
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
            // Optional: Handle expire/cancel/deny
            if($request->transaction_status == 'expire' || $request->transaction_status == 'cancel'){
                 $booking = Booking::where('payment_token', $request->order_id)->first();
                 if($booking) $booking->update(['status' => 'failed']);
            }
        }
    }
}