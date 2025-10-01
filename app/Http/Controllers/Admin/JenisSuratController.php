<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    public function show(Request $request, $id = null)
    {
        // Ambil template dari request kalau ada
        $template = $request->input('template');

        if (!$template && $id) {
            $jenis = JenisSurat::findOrFail($id);
            $template = $jenis->template;
        }

        $data = $request->except(['_token', 'template']);

        $content = \App\Helpers\TemplateHelper::render($template, $data);

        return view('surat.preview-show', [
            'jenis' => $id ? JenisSurat::find($id) : null,
            'content' => $content
        ]);
    }

    public function index()
    {
        $jenis = JenisSurat::latest()->paginate(10);
        return view('admin.jenis_surat.index', compact('jenis'));
    }

    public function create()
    {
        return view('admin.jenis_surat.form', ['jenis' => new JenisSurat()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:jenis_surats,kode',
            'deskripsi' => 'nullable|string',
            'template' => 'nullable|string',
        ]);

        JenisSurat::create($request->all());

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit(JenisSurat $jenis_surat)
    {
        return view('admin.jenis_surat.form', ['jenis' => $jenis_surat]);
    }

    public function update(Request $request, JenisSurat $jenis_surat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:255|unique:jenis_surats,kode,' . $jenis_surat->id,
            'deskripsi' => 'nullable|string',
            'template' => 'nullable|string',
        ]);

        $jenis_surat->update($request->all());

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy(JenisSurat $jenis_surat)
    {
        $jenis_surat->delete();

        return redirect()->route('admin.jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus.');
    }
}