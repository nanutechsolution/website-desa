<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProfileContent; // Import model ProfileContent

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Komposisi data 'footer_about' ke semua view yang menggunakan 'layouts.app' atau 'components.footer'
        View::composer('*', function ($view) { // Menggunakan '*' untuk semua view, bisa lebih spesifik jika perlu
            $footerAbout = ProfileContent::where('key', 'footer_about')->first();
            $view->with('footerAbout', $footerAbout);
        });
    }
}