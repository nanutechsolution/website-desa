<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // <--- TAMBAHKAN INI
use Illuminate\Support\Str;

class LetterGeneratorController extends Controller
{
    /**
     * Show the main form to select a letter type and fill its details.
     */
    public function create()
    {
        $letterTypes = [
            'ownership_certificate' => 'Surat Keterangan Kepemilikan Hewan',
            'domicile_certificate' => 'Surat Keterangan Domisili',
            // Tambahkan jenis surat lain di sini
        ];

        return view('admin.letter_generator.create', compact('letterTypes'));
    }

    /**
     * Generate and display a preview of the letter based on submitted data.
     * This method will now generate a PDF.
     */
    public function generate(Request $request)
    {
        // Validasi umum untuk semua surat
        $request->validate([
            'letter_type' => 'required|string|in:ownership_certificate,domicile_certificate',
            'tanggal_surat' => 'required|date',
            'nomor_surat' => 'required|string|max:50',
        ]);

        $letterData = []; // Variabel untuk menyimpan semua data surat
        $templateView = ''; // Variabel untuk menentukan template Blade yang akan dirender

        // --- Logika untuk Surat Keterangan Kepemilikan Hewan ---
        if ($request->letter_type === 'ownership_certificate') {
            $request->validate([
                'nama_pemilik' => 'required|string|max:255',
                'nik_pemilik' => 'required|string|digits:16',
                'alamat_pemilik' => 'required|string|max:255',
                'jenis_hewan' => 'required|string|max:255',
                'jumlah_hewan' => 'required|integer|min:1',
                'ciri_hewan' => 'required|string',
                'catatan_tambahan' => 'nullable|string',
            ]);

            $letterData = [
                'letter_type_title' => 'Surat Keterangan Kepemilikan Hewan',
                'nomor_surat' => $request->nomor_surat,
                'tanggal_surat' => Carbon::parse($request->tanggal_surat)->locale('id')->isoFormat('D MMMM YYYY'),
                'nama_pemilik' => $request->nama_pemilik,
                'nik_pemilik' => $request->nik_pemilik,
                'alamat_pemilik' => $request->alamat_pemilik,
                'jenis_hewan' => $request->jenis_hewan,
                'jumlah_hewan' => $request->jumlah_hewan,
                'ciri_hewan' => $request->ciri_hewan,
                'catatan_tambahan' => $request->catatan_tambahan,
                'kepala_desa' => 'Radianus', // Ambil dari ProfileContent jika ada
                'jabatan_kepala_desa' => 'Kepala Desa Orakeri', // Ambil dari ProfileContent
            ];
            $templateView = 'admin.letter_generator.templates.ownership_certificate';
        }
        // --- Akhir Logika Surat Keterangan Kepemilikan Hewan ---

        // --- Logika untuk Surat Keterangan Domisili ---
        if ($request->letter_type === 'domicile_certificate') {
            $request->validate([
                'nama_penduduk' => 'required|string|max:255',
                'nik_penduduk' => 'required|string|digits:16',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|string|max:50',
                'pekerjaan' => 'required|string|max:255',
                'alamat_sebelumnya' => 'nullable|string',
                'alamat_sekarang' => 'required|string',
                'keperluan_domisili' => 'required|string',
            ]);

            $letterData = [
                'letter_type_title' => 'Surat Keterangan Domisili',
                'nomor_surat' => $request->nomor_surat,
                'tanggal_surat' => Carbon::parse($request->tanggal_surat)->locale('id')->isoFormat('D MMMM YYYY'),
                'nama_penduduk' => $request->nama_penduduk,
                'nik_penduduk' => $request->nik_penduduk,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => Carbon::parse($request->tanggal_lahir)->locale('id')->isoFormat('D MMMM YYYY'),
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'pekerjaan' => $request->pekerjaan,
                'alamat_sebelumnya' => $request->alamat_sebelumnya,
                'alamat_sekarang' => $request->alamat_sekarang,
                'keperluan_domisili' => $request->keperluan_domisili,
                'kepala_desa' => 'Radianus',
                'jabatan_kepala_desa' => 'Kepala Desa Orakeri',
            ];
            $templateView = 'admin.letter_generator.templates.domicile_certificate';
        }
        // --- Akhir Logika Surat Keterangan Domisili ---

        if (empty($templateView)) {
            return redirect()->back()->with('error', 'Jenis surat tidak dikenal.');
        }

        // --- GENERASI PDF ---
        $pdf = Pdf::loadView($templateView, $letterData);
        return $pdf->download(Str::slug($letterData['letter_type_title'] . '_' . $letterData['nomor_surat']) . '.pdf');
        // --- AKHIR GENERASI PDF ---
    }
}