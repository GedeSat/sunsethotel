<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    public function book(Request $request)
    {
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);
        return response()->json(['message' => 'Booking successful', 'booking' => $booking]);
    }

    public function history(Request $request)
    {
        $bookings = Booking::where('user_id', $request->user()->id)->get();
        return response()->json($bookings);
    }
}
