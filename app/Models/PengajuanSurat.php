<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';

    protected $fillable = [
        'nama',
        'nik',
        'jenis_surat',
        'keperluan',
        'status',
        'catatan_admin',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'diproses';
    const STATUS_COMPLETED = 'selesai';
    const STATUS_REJECTED = 'ditolak';

    // Define any relationships if neededw
}