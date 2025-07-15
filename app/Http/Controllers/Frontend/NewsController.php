<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News; // Import model News
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of news articles.
     */
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(6); // Tampilkan 6 berita per halaman

        return view('frontend.news', compact('news'));
    }

    /**
     * Display a specific news article.
     */
    public function show(string $slug)
    {
        $article = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail(); // Ambil berita berdasarkan slug

        return view('frontend.news_show', compact('article'));
    }
}
