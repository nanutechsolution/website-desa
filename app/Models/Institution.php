<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk membuat slug
use Illuminate\Support\Facades\Storage; // Untuk hapus gambar

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'leader_name',
        'description',
        'category',
        'image',
        'contact_phone',
        'contact_email',
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
        static::creating(function ($institution) {
            $institution->slug = Str::slug($institution->name);
        });

        static::updating(function ($institution) {
            $institution->slug = Str::slug($institution->name);
        });

        // Hapus gambar terkait saat lembaga dihapus
        static::deleting(function ($institution) {
            // Hapus gambar hanya jika itu path lokal
            if ($institution->image && !(Str::startsWith($institution->image, 'http://') || Str::startsWith($institution->image, 'https://')) && Storage::disk('public')->exists($institution->image)) {
                Storage::disk('public')->delete($institution->image);
            }
        });
    }

    // Accessor untuk mendapatkan URL gambar yang benar
    public function getImageUrlAttribute()
    {
        if ($this->image && (Str::startsWith($this->image, 'http://') || Str::startsWith($this->image, 'https://'))) {
            return $this->image;
        } elseif ($this->image) {
            return Storage::url($this->image);
        }
        return asset('images/placeholder-institution.png'); // Placeholder default
    }
}