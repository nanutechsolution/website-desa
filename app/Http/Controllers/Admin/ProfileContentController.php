<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent; // Import model ProfileContent
use Illuminate\Http\Request;

class ProfileContentController extends Controller
{
    /**
     * Show the form for editing specific profile content (Visi, Misi, Sejarah, Struktur).
     * @param string $key The key of the content to edit (e.g., 'visi', 'misi', 'sejarah', 'struktur_pemerintahan').
     */
    public function edit(string $key)
    {
        // Temukan konten berdasarkan key, atau buat yang baru jika belum ada
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
            default:
                $title = 'Konten Profil';
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
            'content' => 'nullable|string',
        ]);

        $profileContent = ProfileContent::firstOrCreate(['key' => $key]);
        $profileContent->content = $request->input('content');
        $profileContent->save();

        return redirect()->back()->with('success', 'Konten ' . $key . ' berhasil diperbarui.');
    }
}
