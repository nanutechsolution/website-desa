<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'deskripsi', 'template'];

    public function surats()
    {
        return $this->hasMany(Surat::class, 'jenis_surat_id');
    }
}