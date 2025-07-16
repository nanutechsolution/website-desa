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
            ->paginate(6);

        $latestNews = News::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('frontend.news', compact('news', 'latestNews'));
    }


    /**
     * Display a specific news article.
     */
    public function show(string $slug)
    {
        $article = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Ambil 5 berita terbaru selain berita ini
        $latestNews = News::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // (Opsional) Kalau kamu punya kategori
        // $categories = Category::has('news')->get();

        return view('frontend.news_show', compact('article', 'latestNews'));
    }
}