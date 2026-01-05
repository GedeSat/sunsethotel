<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Baris yang Anda tambahkan (Oke)
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // --- TAMBAHKAN KODE DI BAWAH INI ---
        // Ini memberitahu Laravel untuk mempercayai Ngrok
        // sehingga error "Unsupported SSL" hilang.
        $middleware->trustProxies(at: '*'); 
        $middleware->validateCsrfTokens(except: [
            'midtrans-notification',      // Sesuaikan dengan URL route Anda
            'api/midtrans-notification',  // Jaga-jaga tulis path lengkapnya
            'payment/notification',       // Atau path lain jika Anda menamainya beda
            ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();