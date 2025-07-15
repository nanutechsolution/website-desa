<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document; // Import model Document
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk kelola file

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::orderBy('order')->paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:documents,title',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', // Maks 10MB
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $filePath = null;
        $fileType = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public_documents', 'public');
            $fileType = $request->file('file')->extension(); // Mendapatkan ekstensi file
        }

        Document::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        return view('admin.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:documents,title,' . $document->id,
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt|max:10240', // Maks 10MB
            'is_published' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $filePath = $document->file_path; // Pertahankan file lama secara default
        $fileType = $document->file_type;
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
            $filePath = $request->file('file')->store('public_documents', 'public');
            $fileType = $request->file('file')->extension();
        }

        $document->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'is_published' => $request->boolean('is_published'),
            'order' => $request->order,
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        // Boot method di model Document akan menghapus file terkait
        $document->delete();
        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
