<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // El panel administrativo y las vistas públicas usan Bootstrap 5,
        // así que la paginación por defecto también se renderiza con esa clase.
        Paginator::useBootstrapFive();

        // Forzar HTTPS en las URLs generadas cuando la app corre detrás de un
        // proxy/balanceador en producción (evita mixed content en assets/links).
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
