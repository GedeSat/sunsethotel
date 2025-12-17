<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\adminDashboard;
use App\Http\Middleware\AdminOnly;

use App\Models\Room;
use App\Models\Booking;


// --------------------------------------------
// HOMEPAGE
// --------------------------------------------
Route::get('/', function () {
    return view('homepage', [
        'title' => 'Sunset Hotel – Homepage'
    ]);
});
Route::get('/about-us', function () {
    return view('aboutUs', [
        'title' => 'Sunset Hotel – About Us'
    ]);
});
Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Sunset Hotel – Contact Us'
    ]);
})->name('contact');


//room
Route::get('/deluxe', function () {
    return view('room.deluxe', [
        'title' => 'Sunset Hotel – Room Deluxe'
    ]);
})->name('room.deluxe');
Route::get('/premium', function () {
    return view('room.premium', [
        'title' => 'Sunset Hotel – Room Premium'
    ]);
})->name('room.premium');
Route::get('/executive', function () {
    return view('room.executive', [
        'title' => 'Sunset Hotel – Room Executive'
    ]);
})->name('room.executive');
Route::get('/golden', function () {
    return view('room.golden', [
        'title' => 'Sunset Hotel – Room Golden'
    ]);
})->name('room.golden');
Route::get('/coastal', function () {
    return view('room.coastal', [
        'title' => 'Sunset Hotel – Room Coastal'
    ]);
})->name('room.coastal');
Route::get('/imperial', function () {
    return view('room.imperal', [
        'title' => 'Sunset Hotel – Room Imperial'
    ]);
})->name('room.imperial');
// --------------------------------------------
// ADMIN DASHBOARD (PAKAI CONTROLLER)
// --------------------------------------------
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin', [adminDashboard::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/admin/rooms', RoomsController::class);

    Route::get('/admin/bookings', [BookingController::class, 'index'])
        ->name('admin.bookings.index');
});


// --------------------------------------------
// LOGIN
// --------------------------------------------
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'Login gagal, cek email/password.']);
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');


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
// USER DASHBOARD
// --------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// --------------------------------------------
// PROFILE
// --------------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// --------------------------------------------
// AUTH ROUTES BREEZE
// --------------------------------------------
require __DIR__.'/auth.php';
