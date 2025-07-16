<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'title', // <-- TAMBAHKAN INI
        'content',
        'type', // <-- TAMBAHKAN INI
        'is_published', // <-- TAMBAHKAN INI
    ];

    protected $casts = [
        'is_published' => 'boolean', // Ini juga diperlukan
    ];
}