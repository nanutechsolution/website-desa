<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Institution; // Import model Institution
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk kelola gambar

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $institutions = Institution::orderBy('order')->paginate(10);
        return view('admin.institutions.index', compact('institutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = [
            'Kelembagaan Masyarakat',
            'Ekonomi',
            'Pendidikan',
            'Keamanan',
            'Kesehatan',
            'Lingkungan',
            'Lain-lain'
        ];
        return view('admin.institutions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name',
            'leader_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Max 2MB
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('institution_images', 'public');
        }

        Institution::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'leader_name' => $request->leader_name,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.institutions.index')->with('success', 'Lembaga berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Institution $institution)
    {
        $categories = [
            'Kelembagaan Masyarakat',
            'Ekonomi',
            'Pendidikan',
            'Keamanan',
            'Kesehatan',
            'Lingkungan',
            'Lain-lain'
        ];
        return view('admin.institutions.edit', compact('institution', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Institution $institution)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:institutions,name,' . $institution->id,
            'leader_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'contact_phone' => 'nullable|string|max:20',
            'contact_email' => 'nullable|email|max:255',
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $imagePath = $institution->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika itu path lokal
            if ($institution->image && !(Str::startsWith($institution->image, 'http://') || Str::startsWith($institution->image, 'https://')) && Storage::disk('public')->exists($institution->image)) {
                Storage::disk('public')->delete($institution->image);
            }
            $imagePath = $request->file('image')->store('institution_images', 'public');
        }

        $institution->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'leader_name' => $request->leader_name,
            'description' => $request->description,
            'category' => $request->category,
            'image' => $imagePath,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.institutions.index')->with('success', 'Lembaga berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Institution $institution)
    {
        // Hapus gambar terkait jika itu path lokal
        if ($institution->image && !(Str::startsWith($institution->image, 'http://') || Str::startsWith($institution->image, 'https://')) && Storage::disk('public')->exists($institution->image)) {
            Storage::disk('public')->delete($institution->image);
        }
        $institution->delete();
        return redirect()->route('admin.institutions.index')->with('success', 'Lembaga berhasil dihapus.');
    }
}