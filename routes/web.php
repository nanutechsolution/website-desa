<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\HomeController; // Import HomeController
use App\Http\Controllers\Frontend\ProfileController as FrontendProfileController; // Import ProfileController frontend dengan alias
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\DocumentController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\InstitutionController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\PotentialController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\ServiceProcedureController;


// Rute Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/layanan-online', function () {
    return view('frontend.surat.create');
})->name('online-services');
Route::get('/kontak', function () {
    return view('frontend.contact');
})->name('contact');


// --- RUTE BAWAAN LARAVEL BREEZE (UNTUK PENGGUNA TERAUTENTIKASI) ---

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Rute Profil Pengguna bawaan Breeze
// Ini untuk mengelola profil pengguna yang login (bukan admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Rute Berita ---
Route::get('/berita', [NewsController::class, 'index'])->name('news');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('news.show');


// --- Rute Galeri ---
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery');
Route::get('/galeri/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

// --- Rute Prosedur Layanan Warga ---
Route::get('/prosedur-layanan', [ServiceProcedureController::class, 'index'])->name('service-procedures');
Route::get('/prosedur-layanan/{slug}', [ServiceProcedureController::class, 'show'])->name('service-procedures.show');


// --- Rute Dokumen Publik ---
Route::get('/dokumen-publik', [DocumentController::class, 'index'])->name('documents');
Route::get('/dokumen-publik/{slug}/unduh', [DocumentController::class, 'download'])->name('documents.download');

// --- Rute Potensi Desa ---
Route::get('/potensi-desa', [PotentialController::class, 'index'])->name('potentials');


// --- Rute Produk Desa ---
Route::get('/produk-desa', [ProductController::class, 'index'])->name('products');
Route::get('/produk-desa/{slug}', [ProductController::class, 'show'])->name('products.show');

// --- Rute Profil Desa ---
Route::get('/profil/visi', [FrontendProfileController::class, 'visionMission'])->name('profil.visi');
Route::get('/profil/sejarah', [FrontendProfileController::class, 'history'])->name('profil.sejarah');
Route::get('/profil/struktur-pemerintahan', [FrontendProfileController::class, 'structure'])->name('profil.struktur');

// --- Rute Komentar (Pengiriman) ---
Route::post('/news/{news}/comments', [CommentController::class, 'store'])->name('comments.store');



// --- Rute Lembaga Desa ---
Route::get('/lembaga-desa', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('/lembaga-desa/{slug}', [InstitutionController::class, 'show'])->name('institutions.show');


// Route::get('/profil/visi-misi', [ProfileController::class, 'visiMisi'])->name('profil.visi');
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';