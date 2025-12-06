<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Middleware\AdminOnly;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

// --------------------------------------------
// HOMEPAGE (TANPA LOGIN)
// --------------------------------------------
Route::get('/', function () {
    return view('homepage');
})->name('homepage');

// --------------------------------------------
// BOOKING
// --------------------------------------------
Route::get('/booking', function () {
    $rooms = Room::all();
    $bookings = Auth::check()
        ? Booking::where('user_id', Auth::id())->with('room')->get()
        : collect();

    return view('booking', compact('rooms', 'bookings'));
})->name('booking');

Route::post('/booking', [BookingController::class, 'book'])
    ->middleware('auth')
    ->name('booking.store');

// --------------------------------------------
// DASHBOARD USER
// --------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --------------------------------------------
// ADMIN ONLY
// --------------------------------------------
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admindashb');
    })->name('admin.admindashb');

    // CRUD ROOMS
    Route::prefix('admin')->group(function () {
        Route::resource('/rooms', RoomsController::class);
    });
});

// --------------------------------------------
// PROFILE
// --------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
