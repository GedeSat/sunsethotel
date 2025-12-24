<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Cek Login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // 2. Cek Role (Sesuai database kamu)
        // Kita cek kolom 'role' apakah isinya 'admin'
        if (Auth::user()->role === 'admin' || Auth::user()->email === 'adminsunset@gmail.com') {
            return $next($request); // Lanjut
        }

        // 3. Jika bukan admin
        // Opsional: Lebih baik pakai abort(403) biar jelas errornya, 
        // tapi redirect('/') juga boleh.
        return redirect ('/');
    }
}