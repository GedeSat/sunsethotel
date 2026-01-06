<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MidtransController;

// Route User (Bawaan Laravel, biarkan saja)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- INI YANG WAJIB ADA ---
Route::post('/midtrans/callback', [MidtransController::class, 'callback']);

use App\Http\Controllers\BookingController;

Route::get('/booked-dates/{roomId}', [BookingController::class, 'getBookedDates']);
