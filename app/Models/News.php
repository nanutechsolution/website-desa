<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author',
        'published_at',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
    ];

    // Relasi: Sebuah berita memiliki banyak komentar
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug'; // <-- TAMBAHKAN BARIS INI
    }

    // Otomatis buat slug saat menyimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });

        // Hapus gambar terkait saat berita dihapus (hanya jika itu path lokal)
        static::deleting(function ($news) {
            // Hapus gambar berita
            if ($news->image && (Str::startsWith($news->image, 'http://') || Str::startsWith($news->image, 'https://'))) {
                // Jangan hapus gambar jika itu URL eksternal
            } elseif ($news->image && Storage::disk('public')->exists($news->image)) {
                Storage::disk('public')->delete($news->image);
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
        return asset('images/placeholder-news.png'); // Placeholder default
    }
}
