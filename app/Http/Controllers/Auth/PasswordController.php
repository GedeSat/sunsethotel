<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
// ...

public function update(Request $request): RedirectResponse
{
    // Tentukan rules validasi secara dinamis
    $validated = $request->validateWithBag('updatePassword', [
        // Jika user punya password (bukan null), maka current_password wajib
        'current_password' => ['nullable', 'current_password'], 
        'password' => ['required', Password::defaults(), 'confirmed'],
    ]);
    
    // Tambahan logika: Jika user punya password tapi field current_password kosong (karena manipulasi form), reject.
    if (!is_null($request->user()->password) && empty($request->current_password)) {
         return back()->withErrors(['current_password' => 'Password saat ini wajib diisi.']);
    }

    $request->user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    return back()->with('status', 'password-updated');
}
}
