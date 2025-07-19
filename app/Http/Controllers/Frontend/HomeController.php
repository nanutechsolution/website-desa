<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Models\Potential;
use App\Models\News;
use App\Models\Gallery;
use App\Models\ProfileContent;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();
        $potentials = Potential::where('is_published', true)->orderBy('order')->take(3)->get();

        $news = News::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->withCount('comments')->get();

        $homepageGalleries = Gallery::where('is_published', true)->orderBy('created_at', 'desc')->take(6)->with('images')->get();

        // Ambil konten profil dinamis
        $sekilasDesa = ProfileContent::where('key', 'sekilas_desa')->first();
        $contactAddress = ProfileContent::where('key', 'contact_address')->first();
        $contactPhone = ProfileContent::where('key', 'contact_phone')->first();
        $contactEmail = ProfileContent::where('key', 'contact_email')->first();
        // --- PERBAIKAN DI SINI UNTUK GOOGLE MAPS ---
        // Ambil entri ProfileContent untuk latitude dan longitude secara terpisah
        $googleMapsLatitudeContent = ProfileContent::where('key', 'Maps_latitude')->first();
        $googleMapsLongitudeContent = ProfileContent::where('key', 'Maps_longitude')->first();

        $googleMapsEmbedUrl = null; // Default null
        // Bangun URL embed langsung di sini
        if (
            $googleMapsLatitudeContent && $googleMapsLatitudeContent->content &&
            $googleMapsLongitudeContent && $googleMapsLongitudeContent->content
        ) {

            $lat = $googleMapsLatitudeContent->content;
            $lon = $googleMapsLongitudeContent->content;
            $googleMapsEmbedUrl = "http://maps.google.com/maps?q={$lat},{$lon}&hl=en&z=15&output=embed";
        }
        // --- AKHIR PERBAIKAN GOOGLE MAPS ---

        $villageName = ProfileContent::where('key', 'village_name')->first();


        return view('frontend.home', compact(
            'sliders',
            'potentials',
            'news',
            'homepageGalleries',
            'sekilasDesa',
            'contactAddress',
            'contactPhone',
            'contactEmail',
            'googleMapsEmbedUrl',
            'villageName'
        ));
    }
}
