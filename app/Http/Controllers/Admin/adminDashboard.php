<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use App\Models\Contact;

class adminDashboard extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $availableRooms = Room::count();
        $totalUsers = User::count();

        $latestBookings = Booking::with(['user', 'room'])
    ->latest()
    ->limit(5)
    ->get();

    $messages = Contact::latest()->take(5)->get();
    


       return view('admin.admindashb', [
    'title' => 'Dashboard Admin',
    'totalBookings' => $totalBookings,
    'availableRooms' => $availableRooms,
    'totalUsers' => $totalUsers,
    'bookings' => $latestBookings,

    'contacts' => $messages,
]);

    }
}
