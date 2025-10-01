<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSurat;

class JenisSuratSeeder extends Seeder
{
    public function run()
    {
        $jenisSurats = [
            [
                'nama' => 'Surat Rekomendasi Kelakuan Baik',
                'kode' => 'SKKB',
                'deskripsi' => 'Surat rekomendasi untuk membuktikan kelakuan baik warga',
                'template' => "SURAT REKOMENDASI KELAKUAN BAIK\n\nYang bertanda tangan di bawah ini Kepala Desa {{desa}}, menerangkan bahwa:\n\nNama   : {{nama}}\nNIK    : {{nik}}\nAlamat : {{alamat}}\n\nBersangkutan adalah warga Desa {{desa}} yang berkelakuan baik.\n\nDemikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.\n\n{{desa}}, {{tanggal}}\nKepala Desa {{desa}}\n\n{{kepala_desa}}",
            ],
            [
                'nama' => 'Surat Keterangan Domisili',
                'kode' => 'SKD',
                'deskripsi' => 'Surat keterangan domisili warga desa',
                'template' => "SURAT KETERANGAN DOMISILI\n\nYang bertanda tangan di bawah ini Kepala Desa {{desa}}, menerangkan bahwa:\n\nNama   : {{nama}}\nNIK    : {{nik}}\nAlamat : {{alamat}}\n\nAdalah benar berdomisili di {{desa}}.\n\nDemikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.\n\n{{desa}}, {{tanggal}}\nKepala Desa {{desa}}\n\n{{kepala_desa}}",
            ],
            [
                'nama' => 'Surat Pengantar',
                'kode' => 'SP',
                'deskripsi' => 'Surat pengantar ke instansi terkait',
                'template' => "SURAT PENGANTAR\n\nYang bertanda tangan di bawah ini Kepala Desa {{desa}}, menerangkan bahwa:\n\nNama   : {{nama}}\nNIK    : {{nik}}\nAlamat : {{alamat}}\n\nBersangkutan adalah warga Desa {{desa}} dan surat ini dibuat untuk keperluan:\n\n{{keperluan}}\n\nDemikian surat pengantar ini dibuat untuk dapat digunakan sebagaimana mestinya.\n\n{{desa}}, {{tanggal}}\nKepala Desa {{desa}}\n\n{{kepala_desa}}",
            ],
        ];

        foreach ($jenisSurats as $surat) {
            JenisSurat::updateOrCreate(
                ['kode' => $surat['kode']],
                $surat
            );
        }
    }
}