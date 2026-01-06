<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Schedule;
// Models
use App\Models\Room;
use App\Models\Booking;
use App\Http\Controllers\ContactController;
// Controllers Public & User
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleAuthController;

// Controllers Admin
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\adminDashboard;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\Admin\AdminBookingController; // <--- [BARU] Tambahkan ini!

// Middleware
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
})->name('homepage');

Route::get('/about-us', function () {
    return view('aboutUs', ['title' => 'Sunset Hotel – About Us']);
});


Route::get('/contact', function () {
    return view('contact'); 
});
// Menjadi seperti ini:
Route::get('/admin/laporan', [ContactController::class, 'laporan'])->name('admin.laporan');
Route::post('/admin/laporan', [ContactController::class, 'store'])->name('contact.store');
/*
|--------------------------------------------------------------------------
| ROOMS (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/room/{slug}', function ($slug) {
    $room = Room::where('slug', $slug)
        ->where('is_active', true)
        ->firstOrFail();

    return view('room.show', compact('room'));
})->name('room.show');

/*
|--------------------------------------------------------------------------
| GOOGLE AUTH
|--------------------------------------------------------------------------
*/
Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| USER DASHBOARD (Setelah Login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| BOOKING & PAYMENT SYSTEM (Perlu Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // 1. Halaman Pilih Kamar / Form Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('booking');
    
    // 2. Simpan Booking
    Route::post('/booking', [BookingController::class, 'book'])->name('booking.store');

    // 3. Proses Booking & Request Token Midtrans (AJAX) - (Sesuai Controller Booking Baru)
    Route::post('/booking/process', [BookingController::class, 'process'])->name('booking.process');
    
    // 4. Halaman Payment (Jika ada)
    Route::get('/booking/payment/{id}', [PaymentController::class, 'pay'])->name('booking.payment');
    
    // 5. User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| MIDTRANS CALLBACK (Webhook)
|--------------------------------------------------------------------------
*/
Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

/*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', AdminOnly::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        
        // Dashboard Admin
        Route::get('/', [adminDashboard::class, 'index'])->name('dashboard');

        // CRUD Rooms
        Route::resource('rooms', RoomsController::class);

        // CRUD Users
        Route::resource('users', UserController::class);

        // --- MANAJEMEN BOOKING & CHECK-IN/OUT (UPDATED) ---
        
        // 1. Menampilkan Daftar Booking (Gunakan Controller Baru)
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('bookings');

        // 2. Proses Update Status (Check In / Check Out) - [BARU]
        Route::put('/bookings/{id}/update', [AdminBookingController::class, 'updateStatus'])->name('bookings.update');
});

/*
|--------------------------------------------------------------------------
| UTILITIES (Testing)
|--------------------------------------------------------------------------
*/
Route::get('/test-email', function () {
    try {
        Mail::raw('Halo, ini tes email dari Sunset Hotel Laravel!', function ($msg) {
            $msg->to('satyanick225@gmail.com')
                ->subject('Tes Koneksi Email');
        });
        return 'Email berhasil dikirim! Cek inbox/spam.';
    } catch (\Exception $e) {
        return 'Gagal kirim: ' . $e->getMessage();
    }
});

Route::get('/cek-pdf', function () {
    $booking = Booking::first(); 
    if(!$booking) return "Belum ada data booking.";
    $pdf = Pdf::loadView('pdf.invoice', ['booking' => $booking]);
    return $pdf->stream();
});

// Route untuk cetak invoice
Route::get('/booking/invoice/{id}', [App\Http\Controllers\BookingController::class, 'printInvoice'])->name('booking.invoice');


Schedule::command('bookings:autocancel')->dailyAt('01:00');
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';