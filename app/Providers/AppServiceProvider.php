<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <--- JANGAN SAMPAI LUPA BARIS INI

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paksa aplikasi menggunakan HTTPS (agar sinkron dengan Ngrok)
        if($this->app->environment('production') || $this->app->environment('local')) {
            URL::forceScheme('https');
        }
    }
}