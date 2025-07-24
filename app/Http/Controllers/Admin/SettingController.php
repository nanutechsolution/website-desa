<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RegularExpression;

class SettingController extends Controller
{
    // Helper function to convert HEX to HSL (approximate)
    private function hexToHsl($hex)
    {
        list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        $h = $s = $l = ($max + $min) / 2;

        if ($max === $min) {
            $h = $s = 0; // achromatic
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            switch ($max) {
                case $r:
                    $h = ($g - $b) / $d + ($g < $b ? 6 : 0);
                    break;
                case $g:
                    $h = ($b - $r) / $d + 2;
                    break;
                case $b:
                    $h = ($r - $g) / $d + 4;
                    break;
            }
            $h /= 6;
        }
        return [round($h * 360), round($s * 100), round($l * 100)];
    }

    public function editGeneralInfo()
    {
        $settingsKeys = [
            'village_name',
            'site_meta_description',
            'site_logo',
            'contact_address',
            'contact_phone',
            'contact_email',
            'Maps_latitude', // Perbaikan Key
            'Maps_longitude', // Perbaikan Key
            'footer_about',
            'brand_primary_color_hsl',
            'brand_secondary_color_hsl',
            'brand_accent_color_hsl',
        ];

        $settings = [];
        foreach ($settingsKeys as $key) {
            if (Str::endsWith($key, '_hsl')) {
                $baseKey = Str::replaceLast('_hsl', '', $key);
                $hue = ProfileContent::firstOrCreate(
                    ['key' => $baseKey . '_hue'],
                    ['title' => Str::title(str_replace('_', ' ', $baseKey)) . ' (Hue)', 'content' => null, 'type' => 'number', 'is_published' => true]
                );
                $saturation = ProfileContent::firstOrCreate(
                    ['key' => $baseKey . '_saturation'],
                    ['title' => Str::title(str_replace('_', ' ', $baseKey)) . ' (Saturation)', 'content' => null, 'type' => 'text', 'is_published' => true]
                );
                $lightness = ProfileContent::firstOrCreate(
                    ['key' => $baseKey . '_lightness'],
                    ['title' => Str::title(str_replace('_', ' ', $baseKey)) . ' (Lightness)', 'content' => null, 'type' => 'text', 'is_published' => true]
                );

                $groupSetting = ProfileContent::firstOrCreate(['key' => $key]);
                $groupSetting->title = Str::title(str_replace('_', ' ', $baseKey)) . ' Color';
                $groupSetting->type = 'color';
                $groupSetting->is_published = true;
                $groupSetting->save();


                $settings[$key] = (object)[
                    'content' => $groupSetting->content ?? '#000000', // HEX code for display
                    'hue' => $hue->content,
                    'saturation' => $saturation->content,
                    'lightness' => $lightness->content,
                    'title' => $groupSetting->title,
                    'type' => $groupSetting->type,
                    'is_published' => $groupSetting->is_published,
                    'db_id' => $groupSetting->id,
                ];
            } else {
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
        }

        // --- Logika gabungan koordinat maps ---
        // PASTIKAN KEY-NYA MENGGUNAKAN UNDERSCORE: Maps_latitude
        $googleMapsLatitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_latitude']);
        $googleMapsLongitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_longitude']);

        $combinedCoords = '';
        if ($googleMapsLatitudeContent->content && $googleMapsLongitudeContent->content) {
            $combinedCoords = $googleMapsLatitudeContent->content . ', ' . $googleMapsLongitudeContent->content;
        }
        $settings['Maps_coords_combined'] = (object)[
            'content' => $combinedCoords,
            'title' => 'Koordinat Google Maps',
            'type' => 'text',
            'is_published' => true,
            'db_id' => null,
        ];
        // --- Akhir logika gabungan ---


        $title = "Pengaturan Umum & Info Desa";
        return view('admin.settings.general_info', compact('settings', 'title'));
    }

    /**
     * Update the general site information.
     */
    public function updateGeneralInfo(Request $request)
    {
        $validationRules = [
            'village_name_content' => 'required|string|max:255',
            'village_name_title' => 'required|string|max:255',
            'contact_address_content' => 'nullable|string',
            'contact_address_title' => 'nullable|string',
            'contact_phone_content' => 'nullable|string|max:20',
            'contact_phone_title' => 'nullable|string',
            'contact_email_content' => 'nullable|email|max:255',
            'contact_email_title' => 'nullable|string',
            // --- KOREKSI KEY DI SINI ---
            'Maps_coords_combined_content' => 'nullable|string',
            'Maps_coords_combined_title' => 'nullable|string',
            // --- AKHIR KOREKSI ---
            'footer_about_content' => 'nullable|string',
            'footer_about_title' => 'nullable|string',
            'site_meta_description_content' => 'nullable|string|max:255',
            'site_meta_description_title' => 'nullable|string',
            'site_logo_content' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_logo_title' => 'nullable|string',
            'site_logo_type' => ['required', Rule::in(['text', 'richtext', 'url', 'image', 'color'])],
            'remove_site_logo_content' => 'nullable|boolean',
            'brand_primary_color_hsl_content' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'brand_primary_color_hsl_title' => 'required|string|max:255',
            'brand_primary_color_hsl_type' => ['required', Rule::in(['text', 'richtext', 'url', 'image', 'color'])],

            'brand_secondary_color_hsl_content' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'brand_secondary_color_hsl_title' => 'required|string|max:255',
            'brand_secondary_color_hsl_type' => ['required', Rule::in(['text', 'richtext', 'url', 'image', 'color'])],

            'brand_accent_color_hsl_content' => ['required', 'string', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
            'brand_accent_color_hsl_title' => 'required|string|max:255',
            'brand_accent_color_hsl_type' => ['required', Rule::in(['text', 'richtext', 'url', 'image', 'color'])],
        ];

        $allowedTypes = ['text', 'richtext', 'url', 'image', 'color'];
        foreach (['village_name', 'contact_address', 'contact_phone', 'contact_email', 'footer_about', 'site_meta_description', 'site_logo', 'brand_primary_color_hsl', 'brand_secondary_color_hsl', 'brand_accent_color_hsl'] as $key) {
            if (isset($request[$key . '_type'])) {
                $validationRules[$key . '_type'] = ['required', Rule::in($allowedTypes)];
            }
        }

        $request->validate($validationRules);

        $keysToProcess = [
            'village_name',
            'contact_address',
            'contact_phone',
            'contact_email',
            'footer_about',
            'site_meta_description',
            'site_logo',
            'brand_primary_color_hsl',
            'brand_secondary_color_hsl',
            'brand_accent_color_hsl'
        ];
        foreach ($keysToProcess as $key) {
            // Logika khusus untuk koordinat (sudah ada di bawah)
            if (in_array($key, ['Maps_latitude', 'Maps_longitude'])) { // Ini akan dilewati
                continue;
            }

            $profileContent = ProfileContent::firstOrCreate(['key' => $key]);

            if ($key === 'site_logo') {
                if ($request->hasFile($key . '_content')) {
                    if ($profileContent->content && !(Str::startsWith($profileContent->content, 'http://') || Str::startsWith($profileContent->content, 'https://')) && Storage::disk('public')->exists($profileContent->content)) {
                        Storage::disk('public')->delete($profileContent->content);
                    }
                    $profileContent->content = $request->file($key . '_content')->store('site_logos', 'public');
                } elseif ($request->boolean('remove_site_logo_content')) {
                    if ($profileContent->content && !(Str::startsWith($profileContent->content, 'http://') || Str::startsWith($profileContent->content, 'https://')) && Storage::disk('public')->exists($profileContent->content)) {
                        Storage::disk('public')->delete($profileContent->content);
                    }
                    $profileContent->content = null;
                } else {
                    // JIKA TIDAK ADA UPLOAD BARU DAN TIDAK HAPUS, PERTAHANKAN NILAI LAMA
                    // Ini dilakukan dengan tidak mengassign $profileContent->content di sini
                    // Model akan otomatis tidak mengupdate atribut yang tidak berubah.
                }
                $profileContent->type = 'image';
                $profileContent->title = $request->input($key . '_title');
                $profileContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $profileContent->save(); // Simpan di sini untuk site_logo agar terpisah dan bisa continue
                continue; // Lanjutkan ke key berikutnya setelah memproses site_logo
            } elseif (Str::endsWith($key, '_hsl')) { // --- Logika untuk menyimpan warna HEX ---
                $hexValue = $request->input($key . '_content');

                $profileContent->content = $hexValue; // Simpan kode HEX langsung ke kolom 'content' untuk key grup
                $profileContent->type = 'color';
                $profileContent->title = $request->input($key . '_title');
                $profileContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $profileContent->save(); // Simpan di sini karena kita tidak memanggil save() di luar loop ini untuk HSL

                // Konversi HEX ke HSL dan simpan ke key terpisah (brand_primary_hue, dll.)
                list($h, $s, $l) = $this->hexToHsl($hexValue);
                $baseKey = Str::replaceLast('_hsl', '', $key);

                $hueContent = ProfileContent::firstOrCreate(['key' => $baseKey . '_hue']);
                $hueContent->content = $h;
                $hueContent->title = $request->input($key . '_title');
                $hueContent->type = 'number';
                $hueContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $hueContent->save();

                $saturationContent = ProfileContent::firstOrCreate(['key' => $baseKey . '_saturation']);
                $saturationContent->content = $s . '%';
                $saturationContent->title = $request->input($key . '_title');
                $saturationContent->type = 'text';
                $saturationContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $saturationContent->save();

                $lightnessContent = ProfileContent::firstOrCreate(['key' => $baseKey . '_lightness']);
                $lightnessContent->content = $l . '%';
                $lightnessContent->title = $request->input($key . '_title');
                $lightnessContent->type = 'text';
                $lightnessContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $lightnessContent->save();

                continue; // Lanjutkan ke key berikutnya setelah memproses HSL
            } else {
                // Untuk semua field lain (text, richtext, url)
                $profileContent->content = $request->input($key . '_content');
                $profileContent->type = $request->input($key . '_type');
                $profileContent->title = $request->input($key . '_title');
                $profileContent->is_published = $request->boolean($key . '_is_published') ?? true;
                $profileContent->save(); // Simpan di sini
            }
        }

        // --- Proses Khusus untuk Koordinat Google Maps ---
        $combinedCoordsInput = $request->input('Maps_coords_combined_content');
        $googleMapsTitle = $request->input('Maps_coords_combined_title');
        $googleMapsIsPublished = $request->boolean('Maps_coords_combined_is_published') ?? true;

        $latitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_latitude']);
        $longitudeContent = ProfileContent::firstOrCreate(['key' => 'Maps_longitude']);

        $latitudeContent->title = $googleMapsTitle;
        $latitudeContent->type = 'text';
        $latitudeContent->is_published = $googleMapsIsPublished;

        $longitudeContent->title = $googleMapsTitle;
        $longitudeContent->type = 'text';
        $longitudeContent->is_published = $googleMapsIsPublished;

        if ($combinedCoordsInput) {
            $coords = explode(',', $combinedCoordsInput);
            if (count($coords) === 2) {
                $latitude = trim($coords[0]);
                $longitude = trim($coords[1]);

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
            $latitudeContent->content = null;
            $longitudeContent->content = null;
        }

        $latitudeContent->save();
        $longitudeContent->save();

        return redirect()->back()->with('success', 'Pengaturan umum berhasil diperbarui.');
    }
}
