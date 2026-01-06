<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminBookingController extends Controller
{
    // 1. MENAMPILKAN DAFTAR BOOKING KE ADMIN
    public function index(Request $request)
    {
        // Mulai Query dengan Eager Loading (biar ringan)
        $query = Booking::with(['user', 'room'])->latest();

        // Logika Pencarian (Search Bar)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->where('order_id', 'like', '%'.$search.'%') // Cari berdasarkan Order ID
                  ->orWhere('name', 'like', '%'.$search.'%')   // Atau cari berdasarkan Nama Tamu (jika ada kolom name)
                  ->orWhereHas('user', function($u) use ($search) {
                      $u->where('name', 'like', '%'.$search.'%'); // Cari nama di tabel users
                  });
            });
        }

        // Ambil data
        $bookings = $query->get();

        // Arahkan ke view (Pastikan file blade ada di folder admin/bookings/index.blade.php)
        return view('admin.adminBooking', compact('bookings'));
    }

    // 2. LOGIKA CHECK-IN & CHECK-OUT
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $action = $request->input('status'); // 'checked_in' atau 'checked_out'

        DB::transaction(function () use ($booking, $action) {
            
            // --- PROSES CHECK IN ---
            if ($action == 'checked_in') {
                $booking->update([
                    'status' => 'checked_in',
                    'check_in_time' => now(), // Catat jam masuk real-time
                ]);

                // Ubah status kamar jadi Terisi
                if($booking->room) {
                    $booking->room->update(['status' => 'occupied']);
                }
            } 
            
            // --- PROSES CHECK OUT ---
            elseif ($action == 'checked_out') {
                $booking->update([
                    'status' => 'checked_out',
                    'check_out_time' => now(), // Catat jam keluar real-time
                ]);

                // Ubah status kamar jadi Tersedia kembali
                if($booking->room) {
                    $booking->room->update(['status' => 'available']);
                }
            }
        });

        return back()->with('success', 'Status tamu berhasil diperbarui!');
    }
}