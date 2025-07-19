<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent; // Model yang digunakan untuk menyimpan pengaturan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Untuk upload file (logo)
use Illuminate\Support\Str; // Untuk sanitasi/pembuatan nama file
use Illuminate\Validation\Rule; // Untuk Rule::in

class SettingController extends Controller
{
    /**
     * Show the form for editing general site information.
     */
    public function editGeneralInfo()
    {
        $settingsKeys = [
            'village_name',
            'site_meta_description',
            'site_logo',
            'contact_address',
            'contact_phone',
            'contact_email',
            'Maps_latitude', // Kita tetap ambil terpisah
            'Maps_longitude', // Kita tetap ambil terpisah
            'footer_about',
        ];

        $settings = [];
        foreach ($settingsKeys as $key) {
            $settings[$key] = ProfileContent::firstOrCreate(
                ['key' => $key],
                [
                    'title' => Str::title(str_replace('_', ' ', $key)),
                    'content' => null,
                    'type' => 'text',
                    'is_published' => true,
                ]
            );
        }

        // --- Tambahkan logika untuk menggabungkan koordinat untuk ditampilkan di satu input ---
        $combinedCoords = '';
        if ($settings['Maps_latitude']->content && $settings['Maps_longitude']->content) {
            $combinedCoords = $settings['Maps_latitude']->content . ', ' . $settings['Maps_longitude']->content;
        }
        $settings['Maps_coords_combined'] = (object)['content' => $combinedCoords, 'title' => 'Koordinat Google Maps', 'type' => 'text'];
        // --- Akhir logika gabungan ---


        $title = "Pengaturan Umum & Info Desa";

        return view('admin.settings.general_info', compact('settings', 'title'));
    }

    /**
     * Update the general site information.
     */
    public function updateGeneralInfo(Request $request)
    {
        // Aturan validasi untuk setiap setting
        $validationRules = [
            'village_name_content' => 'required|string|max:255',
            'village_name_title' => 'required|string|max:255',
            'contact_address_content' => 'nullable|string',
            'contact_address_title' => 'nullable|string',
            'contact_phone_content' => 'nullable|string|max:20',
            'contact_phone_title' => 'nullable|string',
            'contact_email_content' => 'nullable|email|max:255',
            'contact_email_title' => 'nullable|string',
            // --- Validasi untuk input koordinat gabungan ---
            'Maps_coords_combined_content' => 'nullable|string',
            'Maps_coords_combined_title' => 'nullable|string',
            // --- Akhir Validasi ---
            'footer_about_content' => 'nullable|string',
            'footer_about_title' => 'nullable|string',
            'site_meta_description_content' => 'nullable|string|max:255',
            'site_meta_description_title' => 'nullable|string',
            'site_logo_content' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_logo_title' => 'nullable|string',
            'site_logo_type' => 'nullable|string',
            'remove_site_logo' => 'nullable|boolean',
        ];

        // Validasi tipe input (text, richtext, url, image) dari select dropdown
        $allowedTypes = ['text', 'richtext', 'url', 'image'];
        foreach (['village_name', 'contact_address', 'contact_phone', 'contact_email', 'footer_about', 'site_meta_description', 'site_logo'] as $key) {
            $validationRules[$key . '_type'] = ['required', Rule::in($allowedTypes)];
        }

        $request->validate($validationRules);

        // --- Proses Update untuk Setiap Setting ---
        $keysToProcess = [
            'village_name',
            'contact_address',
            'contact_phone',
            'contact_email',
            'footer_about',
            'site_meta_description',
            'site_logo'
        ];

        foreach ($keysToProcess as $key) {
            $profileContent = ProfileContent::firstOrCreate(['key' => $key]);

            // Logika Upload File untuk 'site_logo'
            if ($key === 'site_logo') {
                if ($request->hasFile($key . '_content')) { // Gunakan nama input file yang benar
                    if ($profileContent->content && !(Str::startsWith($profileContent->content, 'http://') || Str::startsWith($profileContent->content, 'https://')) && Storage::disk('public')->exists($profileContent->content)) {
                        Storage::disk('public')->delete($profileContent->content);
                    }
                    $profileContent->content = $request->file($key . '_content')->store('site_logos', 'public');
                } elseif ($request->boolean('remove_site_logo')) {
                    if ($profileContent->content && !(Str::startsWith($profileContent->content, 'http://') || Str::startsWith($profileContent->content, 'https://')) && Storage::disk('public')->exists($profileContent->content)) {
                        Storage::disk('public')->delete($profileContent->content);
                    }
                    $profileContent->content = null;
                } else {
                    // Jika tidak ada upload baru/hapus, pertahankan yang lama dari request (ini penting untuk kasus type=image tanpa perubahan file)
                    $profileContent->content = $request->input($key . '_content');
                }
                $profileContent->type = 'image'; // Tipe untuk logo selalu 'image'
            } else {
                // Untuk semua field lain (text, richtext, url)
                $profileContent->content = $request->input($key . '_content');
                $profileContent->type = $request->input($key . '_type');
            }

            $profileContent->title = $request->input($key . '_title');
            $profileContent->is_published = true; // Anggap semua pengaturan ini selalu dipublikasikan
            $profileContent->save();
        }

        // --- Proses Khusus untuk Koordinat Google Maps ---
        $combinedCoordsInput = $request->input('Maps_coords_combined_content');
        $googleMapsTitle = $request->input('Maps_coords_combined_title');

        $latitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_latitude']);
        $longitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_longitude']);

        // Set default type dan published status jika baru dibuat
        $latitudeContent->title = $googleMapsTitle;
        $latitudeContent->type = 'text';
        $latitudeContent->is_published = true;

        $longitudeContent->title = $googleMapsTitle;
        $longitudeContent->type = 'text';
        $longitudeContent->is_published = true;

        if ($combinedCoordsInput) {
            $coords = explode(',', $combinedCoordsInput);
            if (count($coords) === 2) {
                $latitude = trim($coords[0]);
                $longitude = trim($coords[1]);

                // Validasi numerik setelah parsing
                if (is_numeric($latitude) && is_numeric($longitude)) {
                    $latitudeContent->content = $latitude;
                    $longitudeContent->content = $longitude;
                } else {
                    return redirect()->back()->withInput()->withErrors(['Maps_coords_combined_content' => 'Format koordinat tidak valid. Harap masukkan angka.'])->with('error', 'Format koordinat Google Maps tidak valid.');
                }
            } else {
                return redirect()->back()->withInput()->withErrors(['Maps_coords_combined_content' => 'Format koordinat tidak valid. Gunakan format "latitude, longitude".'])->with('error', 'Format koordinat Google Maps tidak valid.');
            }
        } else {
            // Jika input kosong, hapus koordinat
            $latitudeContent->content = null;
            $longitudeContent->content = null;
        }

        $latitudeContent->save();
        $longitudeContent->save();
        // --- Akhir Proses Khusus Koordinat ---

        return redirect()->back()->with('success', 'Pengaturan umum berhasil diperbarui.');
    }
}
