<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import Str untuk slug
use Illuminate\Support\Facades\Storage; // Import Storage untuk hapus gambar

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Otomatis buat slug saat menyimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($gallery) {
            $gallery->slug = Str::slug($gallery->name);
        });

        static::updating(function ($gallery) {
            $gallery->slug = Str::slug($gallery->name);
        });

        // Hapus cover image dan semua gambar terkait saat galeri dihapus
        static::deleting(function ($gallery) {
            if ($gallery->cover_image && Storage::disk('public')->exists($gallery->cover_image)) {
                Storage::disk('public')->delete($gallery->cover_image);
            }
            // Hapus semua gambar terkait di gallery_images
            $gallery->images->each(function ($image) {
                if ($image->path && Storage::disk('public')->exists($image->path)) {
                    Storage::disk('public')->delete($image->path);
                }
                $image->delete();
            });
        });
    }

    // Relasi One-to-Many: Sebuah galeri memiliki banyak gambar
    public function images()
    {
        return $this->hasMany(GalleryImage::class)->orderBy('order');
    }
}
