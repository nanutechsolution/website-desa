<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Potential; // Import model Potential
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk kelola gambar

class PotentialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potentials = Potential::orderBy('order')->paginate(10);
        return view('admin.potentials.index', compact('potentials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.potentials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:potentials,title',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Batas 2MB
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('potential_images', 'public');
        }

        Potential::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.potentials.index')->with('success', 'Potensi Desa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Potential $potential)
    {
        return view('admin.potentials.edit', compact('potential'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Potential $potential)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:potentials,title,' . $potential->id, // Unique kecuali ID sendiri
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $imagePath = $potential->image; // Pertahankan gambar lama secara default
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($potential->image && Storage::disk('public')->exists($potential->image)) {
                Storage::disk('public')->delete($potential->image);
            }
            $imagePath = $request->file('image')->store('potential_images', 'public');
        }

        $potential->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'image' => $imagePath,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.potentials.index')->with('success', 'Potensi Desa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Potential $potential)
    {
        // Boot method di model Potential akan menghapus gambar terkait
        $potential->delete();
        return redirect()->route('admin.potentials.index')->with('success', 'Potensi Desa berhasil dihapus.');
    }
}