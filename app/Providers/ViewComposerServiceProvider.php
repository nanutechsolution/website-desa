<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\ProfileContent; // Pastikan ini diimport

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
        View::composer('*', function ($view) {
            $footerAbout = ProfileContent::where('key', 'footer_about')->first();
            $villageName = ProfileContent::where('key', 'village_name')->first();
            $siteLogo = ProfileContent::where('key', 'site_logo')->first();
            $brandPrimaryColor = ProfileContent::where('key', 'brand_primary_color_hsl')->first(); // Key yang menyimpan HEX
            $brandSecondaryColor = ProfileContent::where('key', 'brand_secondary_color_hsl')->first();
            $brandAccentColor = ProfileContent::where('key', 'brand_accent_color_hsl')->first();

            $view->with([
                'footerAbout' => $footerAbout,
                'villageName' => $villageName,
                'siteLogo' => $siteLogo,
                'brandPrimaryColor' => $brandPrimaryColor,
                'brandSecondaryColor' => $brandSecondaryColor,
                'brandAccentColor' => $brandAccentColor,
            ]);
        });
    }
}
