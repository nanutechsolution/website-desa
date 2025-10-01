<?php

use App\Http\Admin\SuratPreviewController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\InstitutionController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\LetterGeneratorController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PotentialController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\ServiceProcedureController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SuratPreviewController as AdminSuratPreviewController;
use App\Http\Controllers\Admin\ThemeSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuratController;

// route login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->as('admin.')->group(function () {
    Route::get('theme', [ThemeSettingController::class, 'edit'])->name('theme.edit');
    Route::post('theme', [ThemeSettingController::class, 'update'])->name('theme.update');
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])->names('users');
    Route::resource('hero-sliders', HeroSliderController::class)->names('hero-sliders');
    Route::get('vision-mission', [VisionMissionController::class, 'index'])->name('vision-mission.index');
    Route::get('vision-mission/edit', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
    Route::put('vision-mission', [VisionMissionController::class, 'update'])->name('vision-mission.update');
    // --- Rute Berita ---
    Route::resource('news', NewsController::class)->names('news');
    // --- Rute Potensi Desa ---
    Route::resource('potentials', PotentialController::class)->names('potentials');
    // --- Rute Galeri ---
    Route::resource('galleries', GalleryController::class)->names('galleries');
    // Rute khusus untuk menghapus gambar individu dari galeri
    Route::delete('gallery-images/{image}', [GalleryController::class, 'deleteImage'])->name('galleries.delete-image');
    // --- Rute Prosedur Layanan ---
    Route::resource('service-procedures', ServiceProcedureController::class)->names('service-procedures');
    // --- Rute Dokumen Publik ---
    Route::resource('documents', DocumentController::class)->names('documents');
    // --- Rute Produk Desa ---
    Route::resource('products', ProductController::class)->names('products');
    // --- Rute Komentar (Moderasi) ---
    // Tidak menggunakan Route::resource karena hanya perlu index, update, destroy
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    // --- Rute Lembaga Desa ---
    Route::resource('institutions', InstitutionController::class)->names('institutions');
    // --- Rute Konten Profil (Visi, Misi, Sejarah, Struktur) ---
    // Gunakan rute kustom karena bukan CRUD Resource standar
    Route::get('profile-contents/{key}/edit', [ProfileContentController::class, 'edit'])->name('profile-contents.edit');
    Route::put('profile-contents/{key}', [ProfileContentController::class, 'update'])->name('profile-contents.update');
    // --- Rute Pengaturan Umum & Info Desa (Terkonsolidasi) ---
    Route::get('settings/general-info', [SettingController::class, 'editGeneralInfo'])->name('settings.edit-general-info');
    Route::put('settings/general-info', [SettingController::class, 'updateGeneralInfo'])->name('settings.update-general-info');

    // --- Rute Generator Surat ---
    Route::get('letter-generator/create', [LetterGeneratorController::class, 'create'])->name('letter-generator.create');
    Route::post('letter-generator/generate', [LetterGeneratorController::class, 'generate'])->name('letter-generator.generate');
    Route::resource('/surat', SuratController::class);
    Route::get('/surat/{id}/cetak', [SuratController::class, 'cetak'])->name('surat.cetak');
    Route::get('/surat/{id}/preview', [SuratController::class, 'preview'])->name('surat.preview');
    // form isi data preview
    Route::get('/jenis-surat/{id}/preview', [AdminSuratPreviewController::class, 'form'])
        ->name('jenis-surat.preview');

    // hasil render preview (POST)
    Route::post('/jenis-surat/{id}/preview', [AdminSuratPreviewController::class, 'show'])
        ->name('jenis-surat.preview.show');

    Route::resource('jenis-surat', JenisSuratController::class);
});