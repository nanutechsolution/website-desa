<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function createPublic()
    {
        $jenis = JenisSurat::all();
        return view('frontend.surat.create',  compact('jenis'));
    }
    // Halaman Tracking
    public function tracking()
    {
        return view('frontend.surat.tracking');
    }
    // Simpan Suratxs
    public function storePublic(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|exists:jenis_surats,id',
            'nama_pemohon'   => 'required|string',
            'nik'            => 'required|string',
            'alamat'         => 'required|string',
            'keperluan'      => 'required|string',
        ]);
        $surat = Surat::create([
            'kode_tracking'  => 'SR-' . now()->format('Ymd') . '-' . rand(1000, 9999),
            'jenis_surat_id' => $request->jenis_surat_id,
            'nama_pemohon'   => $request->nama_pemohon,
            'nik'            => $request->nik,
            'alamat'         => $request->alamat,
            'keperluan'      => $request->keperluan,
            'status'         => 'diajukan',
        ]);
        return redirect()->route('surat.tracking')
            ->with('success', 'Permohonan berhasil! Kode Tracking: ' . $surat->kode_tracking);
    }


    public function trackingResult(Request $request)
    {
        $request->validate(['kode_tracking' => 'required']);

        $surat = Surat::where('kode_tracking', $request->kode_tracking)->first();

        return view('frontend.surat.tracking-result', compact('surat'));
    }
    public function index()
    {
        $surats = Surat::latest()->paginate(10);
        return view('admin.surat.index', compact('surats'));
    }
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('admin.surat.show', compact('surat'));
    }
    public function cetak($id)
    {
        $surat = Surat::findOrFail($id);
        $pdf = Pdf::loadView('admin.surat.templates.rekomendasi-kelakuan-baik', compact('surat'))
            ->setPaper('A4', 'portrait')
            ->setOption('dpi', 150)
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);
        return $pdf->download('surat-' . $surat->kode_tracking . '.pdf');
    }
    public function create()
    {
        $surat = new Surat;
        $jenisSurat = JenisSurat::all();
        return view('admin.surat.form', compact('surat', 'jenisSurat'));
    }
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $jenisSurat = JenisSurat::all();
        return view('admin.surat.form', compact('surat', 'jenisSurat'));
    }
    public function preview($id)
    {
        $surat = Surat::with('jenis')->findOrFail($id);
        // Pilih template berdasarkan kode jenis surat
        $view = match ($surat->jenis->kode) {
            'SKKB' => 'admin.surat.templates.rekomendasi-kelakuan-baik',
            'SKD'  => 'admin.surat.templates.keterangan-domisili',
            'SKU'  => 'admin.surat.templates.keterangan-usaha',
            'SKTM' => 'admin.surat.templates.tidak-mampu',
            default => 'admin.surat.templates.default',
        };
        return view($view, compact('surat'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'nama_pemohon' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
        ]);
        Surat::create($request->only(['jenis_surat', 'nama_pemohon', 'nik', 'alamat']));
        return redirect()->route('admin.surat.index')->with('success', 'Surat berhasil diajukan!');
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $surat->status = $request->status;
        $surat->save();
        return redirect()->route('admin.surat.index')
            ->with('success', 'Status surat berhasil diperbarui!');
    }

    public function success($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.frontend.success', compact('surat'));
    }
}