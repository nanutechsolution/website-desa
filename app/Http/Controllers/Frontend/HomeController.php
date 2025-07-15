<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider; // Untuk Hero Slider
use App\Models\Potential;  // Untuk Potensi Desa
use App\Models\News;       // Untuk Berita
use App\Models\ProfileContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $sekilasDesa = ProfileContent::where('key', 'sekilas_desa')->first();

        // Ambil data Hero Slider yang aktif
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();

        // Ambil 3 Potensi Desa terbaru/terurut yang dipublikasikan
        $potentials = Potential::where('is_published', true)->orderBy('order')->take(3)->get();

        // Ambil 3 Berita terbaru yang dipublikasikan
        $news = News::where('is_published', true)->orderBy('published_at', 'desc')->take(3)->get();

        // Kirim semua data ke view home

        return view('frontend.home', compact('sliders', 'potentials', 'news', 'sekilasDesa')); // Tambah sekilasDesa

    }
}
