<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery; // Import model Gallery
use App\Models\GalleryImage; // Import model GalleryImage
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk kelola gambar
use Illuminate\Validation\ValidationException; // Untuk validasi kustom jika diperlukan

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource (Gallery Albums).
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource (Gallery Album).
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created resource in storage (Gallery Album).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:galleries,name',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar sampul
            'is_published' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Untuk multiple image upload
            'captions.*' => 'nullable|string|max:255', // Keterangan untuk gambar baru
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('gallery_covers', 'public');
        }

        $gallery = Gallery::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'is_published' => $request->boolean('is_published'),
        ]);

        // Simpan gambar-gambar tambahan (jika ada)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $imageFile) {
                if ($imageFile) { // Pastikan file tidak null (jika ada input kosong di tengah)
                    $imagePath = $imageFile->store('gallery_images', 'public');
                    GalleryImage::create([
                        'gallery_id' => $gallery->id,
                        'path' => $imagePath,
                        'caption' => $request->captions[$key] ?? null,
                        'order' => $key + 1, // Urutan berdasarkan indeks upload
                    ]);
                }
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil dibuat.');
    }

    /**
     * Display the specified resource (Gallery Album and its Images).
     */
    public function show(Gallery $gallery)
    {
        // Load gambar-gambar terkait untuk ditampilkan
        $gallery->load('images');
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource (Gallery Album).
     */
    public function edit(Gallery $gallery)
    {
        // Load gambar-gambar terkait untuk ditampilkan di form edit
        $gallery->load('images');
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage (Gallery Album).
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:galleries,name,' . $gallery->id,
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'nullable|boolean',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar baru
            'captions.*' => 'nullable|string|max:255', // Keterangan untuk gambar baru

            // Validasi untuk gambar yang sudah ada (dikirim dari JS)
            'existing_image_ids.*' => 'nullable|exists:gallery_images,id', // ID gambar yang sudah ada
            'existing_captions.*' => 'nullable|string|max:255', // Keterangan gambar yang sudah ada
            'existing_order.*' => 'nullable|integer', // Urutan gambar yang sudah ada
            'deleted_images.*' => 'nullable|exists:gallery_images,id', // ID gambar yang ditandai untuk dihapus
        ]);

        // --- Update Cover Image ---
        $coverImagePath = $gallery->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($gallery->cover_image && Storage::disk('public')->exists($gallery->cover_image)) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            $coverImagePath = $request->file('cover_image')->store('gallery_covers', 'public');
        }

        // --- Update Gallery Album Details ---
        $gallery->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'cover_image' => $coverImagePath,
            'is_published' => $request->boolean('is_published'),
        ]);

        // --- Hapus Gambar yang Ditandai untuk Dihapus ---
        if ($request->has('deleted_images')) {
            foreach ($request->input('deleted_images') as $deletedImageId) {
                $imageToDelete = GalleryImage::find($deletedImageId);
                if ($imageToDelete) {
                    if ($imageToDelete->path && Storage::disk('public')->exists($imageToDelete->path)) {
                        Storage::disk('public')->delete($imageToDelete->path);
                    }
                    $imageToDelete->delete();
                }
            }
        }

        // --- Update Gambar yang Sudah Ada ---
        // Logika ini harus disesuaikan dengan cara Anda mengirim data dari form edit.
        // Jika Anda mengirim array asosiatif (id => caption/order), bisa lebih mudah.
        // Asumsi form mengirim existing_image_ids, existing_captions, existing_order sebagai array terpisah.
        if ($request->has('existing_image_ids')) {
            foreach ($request->input('existing_image_ids') as $index => $imageId) {
                $image = GalleryImage::find($imageId);
                if ($image) {
                    // Update caption dan order, atau properti lainnya
                    $image->caption = $request->existing_captions[$imageId] ?? $image->caption;
                    $image->order = $request->existing_order[$imageId] ?? $image->order;
                    $image->save();
                }
            }
        }


        // --- Tambahkan Gambar Baru ---
        if ($request->hasFile('images')) {
            // Dapatkan urutan tertinggi saat ini untuk galeri ini
            $maxOrder = GalleryImage::where('gallery_id', $gallery->id)->max('order');
            $nextOrder = is_null($maxOrder) ? 1 : $maxOrder + 1;

            foreach ($request->file('images') as $key => $imageFile) {
                if ($imageFile) { // Pastikan file tidak null
                    $imagePath = $imageFile->store('gallery_images', 'public');
                    GalleryImage::create([
                        'gallery_id' => $gallery->id,
                        'path' => $imagePath,
                        'caption' => $request->captions[$key] ?? null,
                        'order' => $nextOrder++, // Beri urutan baru yang unik
                    ]);
                }
            }
        }

        return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage (Gallery Album).
     */
    public function destroy(Gallery $gallery)
    {
        // Model Gallery sudah punya boot method untuk menghapus cover image dan semua gambar terkait
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Album galeri berhasil dihapus.');
    }

    /**
     * Remove a single image from a gallery (AJAX or direct).
     * Ini adalah metode terpisah yang bisa dipanggil jika ingin hapus gambar satu per satu.
     * Tidak dipanggil oleh update() tapi bisa lewat tombol di view edit.
     */
    public function deleteImage(GalleryImage $image)
    {
        if ($image->path && Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }
        $image->delete();

        // Redirect back, atau response JSON jika ini request AJAX
        return redirect()->back()->with('success', 'Gambar berhasil dihapus dari album.');
    }
}
