<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'image',
        'category',
        'contact_person',
        'contact_phone',
        'contact_email',
        'is_published',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_published' => 'boolean',
    ];

    // Accessor untuk mendapatkan URL gambar yang benar
    public function getImageUrlAttribute()
    {
        // Jika kolom 'image' dimulai dengan http:// atau https://, berarti itu URL eksternal
        if ($this->image && (Str::startsWith($this->image, 'http://') || Str::startsWith($this->image, 'https://'))) {
            return $this->image;
        }
        // Jika kolom 'image' tidak kosong (berarti path lokal)
        elseif ($this->image) {
            // Gunakan Storage::url() untuk path lokal
            return Storage::url($this->image);
        }
        // Jika tidak ada gambar, kembalikan URL placeholder default
        return asset('images/placeholder-product.png'); // <-- PASTIKAN ANDA MEMILIKI FILE INI
    }

    // Otomatis buat slug saat menyimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        // Hapus gambar terkait saat produk dihapus (hanya jika itu path lokal)
        static::deleting(function ($product) {
            // Hapus hanya jika bukan URL eksternal
            if ($product->image && !(Str::startsWith($product->image, 'http://') || Str::startsWith($product->image, 'https://')) && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
        });
    }
}
