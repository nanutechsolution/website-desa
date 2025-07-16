<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent;
use Illuminate\Http\Request;

class ProfileContentController extends Controller
{
    /**
     * Show the form for editing specific profile content.
     * @param string $key The key of the content to edit.
     */
    public function edit(string $key)
    {
        $content = ProfileContent::firstOrCreate(['key' => $key]);
        $title = '';
        switch ($key) {
            case 'visi':
                $title = 'Visi Desa';
                break;
            case 'misi':
                $title = 'Misi Desa';
                break;
            case 'sejarah':
                $title = 'Sejarah Desa';
                break;
            case 'struktur_pemerintahan':
                $title = 'Struktur Pemerintahan Desa';
                break;
            case 'sekilas_desa':
                $title = 'Sekilas Desa';
                break;
            case 'contact_address':
                $title = 'Alamat Kantor Desa';
                break;
            case 'contact_phone':
                $title = 'Nomor Telepon Desa';
                break;
            case 'contact_email':
                $title = 'Email Desa';
                break;
            case 'Maps_embed':
                $title = 'URL Google Maps Embed';
                break;
            case 'footer_about': // <-- TAMBAHKAN INI
                $title = 'Teks Tentang Desa di Footer';
                break;
            default:
                $title = 'Konten Profil Tidak Dikenal';
                break;
        }

        return view('admin.profile_contents.edit', compact('content', 'title', 'key'));
    }

    /**
     * Update the specified profile content in storage.
     * @param string $key The key of the content to update.
     */
    public function update(Request $request, string $key)
    {
        $request->validate([
            'content' => ($key == 'Maps_embed') ? 'nullable|url' : 'nullable|string',
        ]);

        $profileContent = ProfileContent::firstOrCreate(['key' => $key]);
        $profileContent->content = $request->input('content');
        $profileContent->save();

        $successMessage = 'Konten ' . str_replace('_', ' ', $key) . ' berhasil diperbarui.';
        return redirect()->back()->with('success', $successMessage);
    }
}