<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title',
        'content',
        'type',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];


    public function getGoogleMapsEmbedUrlAttribute()
    {
        if ($this->Maps_latitude && $this->Maps_longitude) {
            $lat = $this->Maps_latitude;
            $lon = $this->Maps_longitude;
            // --- GUNAKAN FORMAT URL INI UNTUK EMBED TANPA API KEY ---
            return "http://maps.google.com/maps?q={$lat},{$lon}&hl=en&z=15&output=embed";
            // --- AKHIR FORMAT URL TANPA API KEY ---
        }
        return null; // Jika koordinat tidak ada
    }
}