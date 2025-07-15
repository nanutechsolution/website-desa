<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id',
        'user_id',
        'guest_name',
        'guest_email',
        'content',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // Relasi: Komentar dimiliki oleh satu Berita
    public function news()
    {
        return $this->belongsTo(News::class);
    }

    // Relasi: Komentar bisa dimiliki oleh satu User (jika user login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
