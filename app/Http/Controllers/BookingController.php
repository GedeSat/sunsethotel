<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use DateTime;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $room = Room::findOrFail($request->room_id);

        $nights = (new DateTime($request->check_in))
                    ->diff(new DateTime($request->check_out))
                    ->days;

        $total = $room->price * $nights;

        Booking::create([
            'user_id'     => Auth::id(),
            'room_id'     => $request->room_id,
            'check_in'    => $request->check_in,
            'check_out'   => $request->check_out,
            'total_price' => $total,
        ]);

        return back()->with('success', 'Booking berhasil dibuat!');
    }

  public function index()
{
    $bookings = Booking::with(['user', 'room'])->latest()->get();
    return view('admin.adminBooking', compact('bookings'));
}
}
