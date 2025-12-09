<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;

class adminDashboard extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $availableRooms = Room::count();
        $totalUsers = User::count();

        return view('admin.admindashb', [
            'title' => 'Dashboard Admin',
            'totalBookings' => $totalBookings,
            'availableRooms' => $availableRooms,
            'totalUsers' => $totalUsers,
        ]);
    }
}
