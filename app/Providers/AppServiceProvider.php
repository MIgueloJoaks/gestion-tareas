<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Forzamos el uso del esquema HTTPS si la aplicación está en entorno de producción
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}
