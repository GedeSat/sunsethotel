<?php

use App\Models\User;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Support\Facades\Route; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;

// Controllers
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\adminDashboard;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminOnly;

/*
|--------------------------------------------------------------------------
| HOMEPAGE & STATIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $rooms = Room::where('is_active', true)->get();

    return view('homepage', [
        'title' => 'Sunset Hotel – Homepage',
        'rooms' => $rooms
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

/*
|--------------------------------------------------------------------------
| ROOMS
|--------------------------------------------------------------------------
*/
// Route::get('/deluxe', function () {
//     return view('room.deluxe', [
//         'title' => 'Sunset Hotel – Room Deluxe'
//     ]);
// })->name('room.deluxe');

// Route::get('/premium', function () {
//     return view('room.premium', [
//         'title' => 'Sunset Hotel – Room Premium'
//     ]);
// })->name('room.premium');

// Route::get('/executive', function () {
//     return view('room.executive', [
//         'title' => 'Sunset Hotel – Room Executive'
//     ]);
// })->name('room.executive');

// Route::get('/golden', function () {
//     return view('room.golden', [
//         'title' => 'Sunset Hotel – Room Golden'
//     ]);
// })->name('room.golden');

// Route::get('/coastal', function () {
//     return view('room.coastal', [
//         'title' => 'Sunset Hotel – Room Coastal'
//     ]);
// })->name('room.coastal');

// Route::get('/imperial', function () {
//     return view('room.imperal', [ // Sesuai kode asli (imperal)
//         'title' => 'Sunset Hotel – Room Imperial'
//     ]);
// })->name('room.imperial');

Route::get('/room/{slug}', function ($slug) {
    $room = Room::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('room.show', compact('room'));
})->name('room.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION (Login/Logout)
|--------------------------------------------------------------------------
*/
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

/*
|--------------------------------------------------------------------------
| BOOKING SYSTEM
|--------------------------------------------------------------------------
*/
Route::get('/booking', [BookingController::class, 'index'])
    ->name('booking');

Route::post('/booking', [BookingController::class, 'book'])
    ->middleware('auth')
    ->name('booking.store');

// [DI-COMMENT SUPAYA TIDAK ERROR]
// Baris di bawah ini diduplikasi. Jika dinyalakan, kode 'function' di atas (baris 113) tidak akan jalan.
// Route::get('/booking', [BookingController::class, 'index'])->name('booking');

/*
|--------------------------------------------------------------------------
| PAYMENT & MIDTRANS
|--------------------------------------------------------------------------
*/
Route::get('/booking/payment/{id}', [PaymentController::class, 'pay'])->name('booking.payment');
Route::post('/booking/process', [PaymentController::class, 'process'])->name('booking.process');
Route::post('/midtrans/callback', [PaymentController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| DASHBOARDS (User & Admin)
|--------------------------------------------------------------------------
*/
// User Dashboard
Route::get('/login', function () {
    return view('auth.login');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Dashboard
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin', [adminDashboard::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('/admin/rooms', RoomsController::class);

  // Route Booking (Ke function bookings) <-- PASTIKAN INI KE 'bookings'
Route::get('/admin/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
});

Route::middleware(['auth', AdminOnly::class])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth', AdminOnly::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('users', UserController::class);
});


/*
|--------------------------------------------------------------------------
| USER PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';