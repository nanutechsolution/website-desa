<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisSurat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuratPreviewController extends Controller
{
    // tampilkan form isi data
    public function form($id)
    {
        $jenis = JenisSurat::findOrFail($id);
        return view('admin.surat.preview-form', compact('jenis'));
    }

    public function show(Request $request, $id)
    {
        $jenis = JenisSurat::findOrFail($id);

        // ini aman karena pakai instance Request
        $data = $request->except(['_token', 'template']);

        $template = $request->input('template') ?? $jenis->template;

        $content = \App\Helpers\TemplateHelper::render($template, $data);

        return view('admin.surat.preview-show', compact('jenis', 'content'));
    }
}