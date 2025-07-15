<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product; // Import model Product
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of published products.
     */
    public function index()
    {
        $products = Product::where('is_published', true)
            ->orderBy('order')
            ->paginate(9); // Tampilkan 9 produk per halaman

        return view('frontend.products.index', compact('products'));
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
