<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\InstitutionController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PotentialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\ServiceProcedureController;
use App\Http\Controllers\Admin\VisionMissionController;

// route login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
// Tambahkan use App\Http\Controllers\Admin\... untuk kontroler admin lainnya di sini

// Semua rute di dalam grup ini akan memiliki prefix '/admin'
// dan hanya dapat diakses oleh pengguna yang sudah terautentikasi dan terverifikasi.
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard'); // Menggunakan nama rute yang di-prefix agar unik

    // Rute untuk pengelolaan Hero Slider (CRUD)
    Route::resource('hero-sliders', HeroSliderController::class)->names('admin.hero-sliders');
    Route::get('/vision-mission', [VisionMissionController::class, 'index'])->name('admin.vision-mission.index');
    Route::get('/vision-mission/edit', [VisionMissionController::class, 'edit'])->name('admin.vision-mission.edit');
    Route::put('/vision-mission', [VisionMissionController::class, 'update'])->name('admin.vision-mission.update');


    // --- Rute Berita ---
    Route::resource('news', NewsController::class)->names('admin.news');

    // --- Rute Potensi Desa ---
    Route::resource('potentials', PotentialController::class)->names('admin.potentials');

    // --- Rute Galeri ---
    Route::resource('galleries', GalleryController::class)->names('admin.galleries');
    // Rute khusus untuk menghapus gambar individu dari galeri
    Route::delete('gallery-images/{image}', [GalleryController::class, 'deleteImage'])->name('admin.galleries.delete-image');


    // --- Rute Prosedur Layanan ---
    Route::resource('service-procedures', ServiceProcedureController::class)->names('admin.service-procedures');

    // --- Rute Dokumen Publik ---
    Route::resource('documents', DocumentController::class)->names('admin.documents');


    // --- Rute Produk Desa ---
    Route::resource('products', ProductController::class)->names('admin.products');
    // --- Rute Komentar (Moderasi) ---
    // Tidak menggunakan Route::resource karena hanya perlu index, update, destroy
    Route::get('/comments', [CommentController::class, 'index'])->name('admin.comments.index');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('admin.comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('admin.comments.destroy');
    // --- Rute Lembaga Desa ---
    Route::resource('institutions', InstitutionController::class)->names('admin.institutions');


    // --- Rute Konten Profil (Visi, Misi, Sejarah, Struktur) ---
    // Gunakan rute kustom karena bukan CRUD Resource standar
    Route::get('/profile-contents/{key}/edit', [ProfileContentController::class, 'edit'])->name('admin.profile-contents.edit');
    Route::put('/profile-contents/{key}', [ProfileContentController::class, 'update'])->name('admin.profile-contents.update');
});