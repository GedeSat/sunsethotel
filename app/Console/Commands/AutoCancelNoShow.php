<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking; // Pastikan Model Booking di-import
use Carbon\Carbon;

class AutoCancelNoShow extends Command
{
    /**
     * Nama perintah yang akan kita panggil nanti.
     */
    protected $signature = 'bookings:autocancel';

    /**
     * Keterangan perintah.
     */
    protected $description = 'Otomatis cancel booking jika tamu tidak check-in setelah tanggal lewat';

    /**
     * Eksekusi perintah.
     */
    public function handle()
    {
        // 1. Ambil tanggal HARI INI jam 00:00
        $today = Carbon::now()->startOfDay();

        // 2. Cari data yang:
        // - Tanggal Check-in KURANG DARI hari ini (berarti kemarin atau lusa)
        // - Statusnya BELUM Check-in (masih booked/paid/confirmed)
        // - Statusnya BELUM Canceled
        $expiredBookings = Booking::where('check_in', '<', $today)
            ->whereIn('status', ['booked', 'confirmed', 'paid', 'pending']) 
            ->get();

        $count = 0;

        foreach ($expiredBookings as $booking) {
            // Ubah status jadi canceled
            $booking->update([
                'status' => 'canceled'
            ]);
            
            // Opsi Tambahan: Jika mau ubah payment_status jadi 'failed' atau 'expired' juga bisa
            // $booking->update(['payment_status' => 'expired']);

            $this->info("Booking ID: {$booking->order_id} berhasil dicancel otomatis (No Show).");
            $count++;
        }

        if ($count > 0) {
            $this->info("SELESAI! Total {$count} booking hangus telah dibatalkan.");
        } else {
            $this->info("Tidak ada booking kadaluarsa hari ini.");
        }
    }
}