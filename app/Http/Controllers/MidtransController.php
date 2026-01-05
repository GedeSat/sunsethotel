<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\BookingInvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Midtrans\Config;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Exception;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        try {
            // 1. Log Data Masuk
            Log::info('MIDTRANS CALLBACK HIT:', $request->all());

            // 2. Set Config Midtrans
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // 3. Cari Booking berdasarkan Order ID
            $booking = Booking::where('order_id', $request->order_id)->first();

            if (!$booking) {
                Log::error('ORDER ID TIDAK DITEMUKAN: ' . $request->order_id);
                return response()->json(['message' => 'Booking not found'], 404);
            }

            // 4. Handle Status Transaksi
            $transactionStatus = $request->transaction_status;
            $paymentType = $request->payment_type ?? 'unknown'; 

            Log::info("Order ID: {$booking->order_id} | Status Midtrans: {$transactionStatus}");

            switch ($transactionStatus) {
                // KONDISI PEMBAYARAN SUKSES
                case 'capture':
                case 'settlement':
                    Log::info("Proses update ke PAID dimulai...");
                    
                    // Update Database
                    $booking->payment_status = 'paid'; 
                    $booking->status = 'confirmed';
                    $booking->payment_type = $paymentType;
                    $booking->paid_at = now();
                    
                    $booking->save();
                    
                    Log::info("SUKSES! Database berhasil diupdate jadi PAID.");

                    // --- [MULAI] KIRIM EMAIL INVOICE DISINI ---
                    try {
                        // Cek user punya email valid
                        if ($booking->user && $booking->user->email) {
                            Mail::to($booking->user->email)->send(new BookingInvoiceMail($booking));
                            Log::info("Email Invoice BERHASIL dikirim ke: " . $booking->user->email);
                        }
                    } catch (\Exception $e) {
                        // Log error saja, jangan gagalkan transaksi midtransnya
                        Log::error('GAGAL kirim invoice email: ' . $e->getMessage());
                    }
                    // --- [SELESAI] ---

                    break;

                // KONDISI PENDING
                case 'pending':
                    $booking->update([
                        'payment_status' => 'pending',
                        'status' => 'pending',
                    ]);
                    Log::info("Status update jadi PENDING.");
                    break;

                // KONDISI GAGAL
                case 'deny':
                case 'expire':
                case 'cancel':
                    $booking->update([
                        'payment_status' => 'failed',
                        'status' => 'cancelled',
                    ]);
                    Log::info("Status update jadi FAILED/CANCELLED.");
                    break;
            }

            return response()->json(['message' => 'Callback received']);

        } catch (Exception $e) {
            Log::error('ERROR FATAL DI CALLBACK: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return response()->json(['message' => 'Error processing callback'], 500);
        }
    }
}