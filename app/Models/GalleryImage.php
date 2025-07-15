<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Import Storage untuk hapus gambar

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'path',
        'caption',
        'order',
    ];

    // Relasi Many-to-One: Sebuah gambar galeri dimiliki oleh satu galeri
    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
