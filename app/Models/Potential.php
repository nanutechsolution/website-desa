<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk hapus gambar

class Potential extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'is_published',
        'order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Otomatis buat slug saat menyimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($potential) {
            $potential->slug = Str::slug($potential->title);
        });

        static::updating(function ($potential) {
            $potential->slug = Str::slug($potential->title);
        });

        // Hapus gambar terkait saat potensi dihapus
        static::deleting(function ($potential) {
            if ($potential->image && Storage::disk('public')->exists($potential->image)) {
                Storage::disk('public')->delete($potential->image);
            }
        });
    }
}
