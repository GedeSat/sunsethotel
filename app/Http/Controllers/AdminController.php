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
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Pastikan user adalah admin
        if (! ($user && ($user->is_admin ?? false))) {
            abort(403, 'Unauthorized');
        }

        $hotelsCount = Hotel::count();
        $roomsCount = Room::count();
        $bookingsCount = Booking::count();

        return view('admin.dashboard', compact('user', 'hotelsCount', 'roomsCount', 'bookingsCount'));
    }
}
