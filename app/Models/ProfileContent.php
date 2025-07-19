<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'type',
        'is_published',
        'Maps_latitude',
        'Maps_longitude',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Accessor untuk mendapatkan URL gambar logo (jika type-nya 'image')
    public function getImageUrlAttribute()
    {
        if ($this->type === 'image' && $this->content && (Str::startsWith($this->content, 'http://') || Str::startsWith($this->content, 'https://'))) {
            return $this->content; // Sudah URL eksternal
        } elseif ($this->type === 'image' && $this->content) {
            return Storage::url($this->content); // Path lokal
        }
        return asset('images/logo.jpg'); // Placeholder default
    }

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($profileContent) {
            if ($profileContent->isDirty('content') && $profileContent->type === 'image' && $profileContent->getOriginal('content')) {
                // Hapus gambar lama hanya jika itu path lokal
                if (!(Str::startsWith($profileContent->getOriginal('content'), 'http://') || Str::startsWith($profileContent->getOriginal('content'), 'https://')) && Storage::disk('public')->exists($profileContent->getOriginal('content'))) {
                    Storage::disk('public')->delete($profileContent->getOriginal('content'));
                }
            }
        });

        static::deleting(function ($profileContent) {
            if ($profileContent->type === 'image' && $profileContent->content) {
                if (!(Str::startsWith($profileContent->content, 'http://') || Str::startsWith($profileContent->content, 'https://')) && Storage::disk('public')->exists($profileContent->content)) {
                    Storage::disk('public')->delete($profileContent->content);
                }
            }
        });
    }
}
