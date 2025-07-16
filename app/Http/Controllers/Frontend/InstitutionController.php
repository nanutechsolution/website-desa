<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Institution; // Import model Institution
use Illuminate\Http\Request;

class InstitutionController extends Controller
{
    /**
     * Display a listing of published institutions.
     */
    public function index()
    {
        $institutions = Institution::where('is_published', true)
            ->orderBy('order')
            ->paginate(9); // Tampilkan 9 lembaga per halaman

        return view('frontend.institutions.index', compact('institutions'));
    }

    /**
     * Display a specific institution.
     */
    public function show(string $slug)
    {
        $institution = Institution::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.institutions.show', compact('institution'));
    }
}