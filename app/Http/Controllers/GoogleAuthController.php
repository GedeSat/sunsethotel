<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    // 1. Redirect
    public function redirect()
    {
        // stateless() disini opsional, tapi boleh dipakai agar konsisten
        return Socialite::driver('google')->stateless()->redirect();
    }

    // 2. Callback (PENENTU FIX ERROR)
    public function callback()
    {
        // stateless() DISINI YANG PALING PENTING
        // Abaikan garis merah di VS Code, kode ini valid.
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Logika login/register
        $user = User::where('google_id', $googleUser->id)
                    ->orWhere('email', $googleUser->email)
                    ->first();

        if ($user) {
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->id]);
            }
            Auth::login($user);
            return redirect()->intended('/');
        } else {
            $newUser = User::create([ 
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(Str::random(16)),
            ]);

            Auth::login($newUser);
            return redirect()->intended('/');
        }
    }
}