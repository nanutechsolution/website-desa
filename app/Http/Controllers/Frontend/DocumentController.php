<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Document; // Import model Document
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk membuat URL download

class DocumentController extends Controller
{
    /**
     * Display a listing of published documents.
     */
    public function index()
    {
        $documents = Document::where('is_published', true)
            ->orderBy('order')
            ->paginate(10); // Tampilkan 10 dokumen per halaman

        return view('frontend.documents', compact('documents'));
    }

    /**
     * Handle document download.
     */
    public function download(string $slug)
    {
        $document = Document::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Pastikan file ada di storage
        if (Storage::disk('public')->exists($document->file_path)) {
            // Memberikan nama file asli saat download
            $fileName = basename($document->file_path);
            // Atau Anda bisa menggunakan judul dokumen sebagai nama file
            // $fileName = Str::slug($document->title) . '.' . $document->file_type;
            return Storage::disk('public')->download($document->file_path, $fileName);
        }

        // Jika file tidak ditemukan
        abort(404, 'Dokumen tidak ditemukan.');
    }
}
