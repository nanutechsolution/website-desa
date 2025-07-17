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

        // --- Perbaikan N+1 untuk Berita ---
        // Jika Anda menampilkan jumlah komentar atau relasi lain dari berita di homepage,
        // tambahkan withCount('comments') atau with('relasi_lain').
        $news = News::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->withCount('comments')->get();
        // --- Akhir Perbaikan N+1 Berita ---

        // --- Perbaikan N+1 untuk Galeri ---
        // Memuat gambar-gambar terkait dengan album galeri untuk homepage
        $homepageGalleries = Gallery::where('is_published', true)->orderBy('created_at', 'desc')->take(6)->with('images')->get();
        // --- Akhir Perbaikan N+1 Galeri ---


        // Ambil Konten Profil Dinamis (termasuk kontak dan sekilas desa)
        // Fetch ini bukan masalah N+1 klasik karena mereka adalah pengambilan record tunggal yang spesifik berdasarkan 'key'.
        $sekilasDesa = ProfileContent::where('key', 'sekilas_desa')->first();
        $contactAddress = ProfileContent::where('key', 'contact_address')->first();
        $contactPhone = ProfileContent::where('key', 'contact_phone')->first();
        $contactEmail = ProfileContent::where('key', 'contact_email')->first();
        $googleMapsEmbedUrl = ProfileContent::where('key', 'Maps_embed')->first();

        // --- Akhir Perbaikan Google Maps ---

        $villageName = ProfileContent::where('key', 'village_name')->first();

        return view('frontend.home', compact(
            'sliders',
            'potentials',
            'news', // Sekarang sudah dioptimalkan dengan withCount('comments')
            'homepageGalleries', // Sudah dioptimalkan dengan with('images')
            'sekilasDesa',
            'contactAddress',
            'contactPhone',
            'contactEmail',
            'googleMapsEmbedUrl',
            'villageName'
        ));
    }
}