<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tracking',
        'jenis_surat_id',
        'nama_pemohon',
        'nik',
        'alamat',
        'keperluan',
        'status',
    ];
    public function jenis()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }
}