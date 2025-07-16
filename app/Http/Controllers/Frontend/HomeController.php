<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use App\Models\Potential;
use App\Models\News;
use App\Models\Gallery; // Pastikan ini ada jika di homepage
use App\Models\ProfileContent; // <-- PASTIKAN INI ADA
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();
        $potentials = Potential::where('is_published', true)->orderBy('order')->take(3)->get();
        $news = News::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();

        // Ambil data galeri untuk homepage
        $homepageGalleries = Gallery::where('is_published', true)->orderBy('created_at', 'desc')->take(6)->with('images')->get();

        // --- Ambil Konten Profil Dinamis (termasuk kontak dan sekilas desa) ---
        $sekilasDesa = ProfileContent::where('key', 'sekilas_desa')->first(); // Pastikan ini ada

        $contactAddress = ProfileContent::where('key', 'contact_address')->first();
        $contactPhone = ProfileContent::where('key', 'contact_phone')->first();
        $contactEmail = ProfileContent::where('key', 'contact_email')->first();
        $googleMapsEmbedUrl = ProfileContent::where('key', 'Maps_embed')->first();
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
