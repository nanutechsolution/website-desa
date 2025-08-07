<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\InstitutionController;
use App\Http\Controllers\Admin\LetterGeneratorController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PotentialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\ServiceProcedureController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\AdminController;

// route login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/theme', [ThemeSettingController::class, 'edit'])->name('admin.theme.edit');
    Route::post('/theme', [ThemeSettingController::class, 'update'])->name('admin.theme.update');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('admin.users');
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
    // --- Rute Pengaturan Umum & Info Desa (Terkonsolidasi) ---
    Route::get('/settings/general-info', [SettingController::class, 'editGeneralInfo'])->name('admin.settings.edit-general-info');
    Route::put('/settings/general-info', [SettingController::class, 'updateGeneralInfo'])->name('admin.settings.update-general-info');

    // --- Rute Generator Surat ---
    Route::get('/letter-generator/create', [LetterGeneratorController::class, 'create'])->name('admin.letter-generator.create');
    Route::post('/letter-generator/generate', [LetterGeneratorController::class, 'generate'])->name('admin.letter-generator.generate');
});
