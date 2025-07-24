<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ThemeSettingController extends Controller
{
    public function edit()
    {
        return view('admin.theme.edit', [
            'primary' => SiteSetting::getSetting('brand_primary_color_hsl'),
            'secondary' => SiteSetting::getSetting('brand_secondary_color_hsl'),
            'accent' => SiteSetting::getSetting('brand_accent_color_hsl'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_primary_color_hsl' => 'required|string',
            'brand_secondary_color_hsl' => 'required|string',
            'brand_accent_color_hsl' => 'required|string',
        ]);

        foreach ($request->only(['brand_primary_color_hsl', 'brand_secondary_color_hsl', 'brand_accent_color_hsl']) as $key => $value) {
            SiteSetting::updateOrCreate(['name' => $key], ['value' => $value]);
        }

        return redirect()->back()->with('success', 'Warna tema berhasil diperbarui.');
    }
}
