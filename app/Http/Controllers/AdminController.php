<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;

class AdminController extends Controller
{
    public function __construct()
    {
        // Middleware Auth tetap diperlukan
        $this->middleware('auth');
        
        // OPTIONAL: Jika ingin middleware admin dipasang disini (bukan di route)
        // $this->middleware(\App\Http\Middleware\AdminOnly::class);
    }

    // 1. Fungsi untuk Halaman Dashboard Utama
    public function index()
    {
        // HAPUS pengecekan 'is_admin' disini.
        // Biarkan Middleware 'AdminOnly' di Route yang bekerja menjaga pintu.
        // Kalau user sampai sini, berarti dia PASTI admin.

        $user = Auth::user();
        $hotelsCount = Hotel::count();
        $roomsCount = Room::count();
        $bookingsCount = Booking::count();

        // Ini hanya menampilkan dashboard
        return view('admin.dashboard', compact('user', 'hotelsCount', 'roomsCount', 'bookingsCount'));
    }

    // 2. Fungsi KHUSUS untuk Halaman Booking
    public function bookings()
    {
        // Ambil semua data booking (terbaru di atas)
        // 'with' digunakan agar query lebih cepat (eager loading) jika ada relasi ke room/user
        $bookings = Booking::with(['room', 'user'])->latest()->get(); 

        // Return ke view khusus tabel booking
        return view('admin.adminBooking', compact('bookings'));
    }
}