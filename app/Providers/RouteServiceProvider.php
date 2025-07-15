<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard'; // Pastikan ini '/dashboard' untuk registrasi

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Rute API default
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Rute Web default (public frontend dan Breeze auth)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Rute Auth Breeze (login, register, dll.)
            // Di Laravel 12, ini seringkali sudah di-auto-load, tapi eksplisit lebih aman.
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            // Rute Admin kustom Anda (di-load dengan prefix 'admin')
            // Pastikan ini ada agar routes/admin.php terdaftar
            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));
        });
    }
}