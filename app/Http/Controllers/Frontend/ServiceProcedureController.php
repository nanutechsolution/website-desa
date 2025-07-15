<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServiceProcedure; // Import model ServiceProcedure
use Illuminate\Http\Request;

class ServiceProcedureController extends Controller
{
    /**
     * Display a listing of published service procedures.
     */
    public function index()
    {
        $procedures = ServiceProcedure::where('is_published', true)
            ->orderBy('order')
            ->paginate(10);

        return view('frontend.service_procedures.index', compact('procedures'));
    }

    /**
     * Display a specific service procedure.
     */
    public function show(string $slug)
    {
        $procedure = ServiceProcedure::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        return view('frontend.service_procedures.show', compact('procedure'));
    }
}
