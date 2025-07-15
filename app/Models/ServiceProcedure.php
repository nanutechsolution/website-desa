<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Untuk membuat slug

class ServiceProcedure extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'steps_requirements',
        'category',
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
        static::creating(function ($procedure) {
            $procedure->slug = Str::slug($procedure->title);
        });

        static::updating(function ($procedure) {
            $procedure->slug = Str::slug($procedure->title);
        });
    }
}
