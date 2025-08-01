<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of published products with filtering.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        $query = Product::where('is_published', true)->orderBy('order');

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        // --- Logika filter harga ---
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        } elseif ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        } elseif ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        // --- Akhir logika filter harga ---

        $products = $query->paginate(9);

        // Ambil semua kategori unik untuk filter sidebar
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->toArray();
        array_unshift($categories, 'Semua Kategori');

        // Definisikan range harga untuk filter
        $priceRanges = [
            ['min' => 0, 'max' => 50000, 'label' => 'Rp 0 - Rp 50.000'],
            ['min' => 50001, 'max' => 200000, 'label' => 'Rp 50.001 - Rp 200.000'],
            ['min' => 200001, 'max' => null, 'label' => '> Rp 200.000'],
        ];

        return view('frontend.products.index', compact('products', 'categories', 'category', 'minPrice', 'maxPrice', 'priceRanges'));
    }

    /**
     * Display a specific product.
     */
    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.products.show', compact('product'));
    }
}