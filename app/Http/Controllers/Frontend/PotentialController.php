<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Potential; // Import model Potential
use Illuminate\Http\Request;

class PotentialController extends Controller
{
    /**
     * Display a listing of potentials.
     */
    public function index()
    {
        $potentials = Potential::where('is_published', true)
            ->orderBy('order')
            ->paginate(9); // Tampilkan 9 potensi per halaman

        return view('frontend.potentials', compact('potentials'));
    }

    // Jika Anda ingin halaman detail untuk setiap potensi
    /*
    public function show(string $slug)
    {
        $potential = Potential::where('slug', $slug)
                              ->where('is_published', true)
                              ->firstOrFail();

        return view('frontend.potentials_show', compact('potential'));
    }
    */
}
