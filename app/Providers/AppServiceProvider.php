<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

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
        // Asegura compatibilidad de bases de datos antiguas (MySQL <= 5.7)
        Schema::defaultStringLength(191);

        // Forzar HTTPS en producción
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Usar Bootstrap 5 en paginaciones automáticas
        Paginator::useBootstrapFive();
    }
}
