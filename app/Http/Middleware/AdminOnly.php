<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
public function handle(Request $request, Closure $next)
{
    if (!Auth::check()) {
        return redirect('/login'); // belum login ke login
    }

    if (Auth::user()->email === 'adminsunset@gmail.com' || Auth::user()->is_admin) {
        return $next($request); // admin boleh lanjut
    }

    return redirect('/'); // selain admin ke homepage
}
}