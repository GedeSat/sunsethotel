<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle($request, Closure $next)
    {
        // cek user sudah login dan email = admin
        if (!Auth::check() || Auth::user()->email !== 'adminsunset@gmail.com') {
            return redirect('/'); // tolak selain admin
        }

        return $next($request);
    }
}

