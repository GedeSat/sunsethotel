<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;


Route::post('/booking', [BookingController::class, 'book'])->name('booking.book');

Route::get('/', function () {
    return view('welcome');
});
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

Route::get('/booking', function () {
    $rooms = Room::all();
    $bookings = Auth::check() ? Booking::where('user_id', Auth::id())->with('room')->get() : collect();
    return view('booking', compact('rooms', 'bookings'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return view('admin.index');
});

require __DIR__.'/auth.php';
