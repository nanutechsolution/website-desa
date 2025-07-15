<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery; // Import model Gallery
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery albums.
     */
    public function index()
    {
        $galleries = Gallery::where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->with('images') // Eager load gambar-gambar di setiap galeri
            ->paginate(9); // Tampilkan 9 album per halaman

        return view('frontend.gallery.gallery', compact('galleries'));
    }

    /**
     * Display a specific gallery album and its images.
     */
    public function show(string $slug)
    {
        $gallery = Gallery::where('slug', $slug)
            ->where('is_published', true)
            ->with('images') // Eager load gambar-gambar
            ->firstOrFail();

        return view('frontend.gallery.gallery_show', compact('gallery'));
    }
}
