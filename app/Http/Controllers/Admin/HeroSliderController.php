<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Pastikan ini di-import

class HeroSliderController extends Controller
{
    /**
     * Tampilkan daftar sumber daya.
     */
    public function index()
    {
        $sliders = HeroSlider::orderBy('order')->paginate(10); // Tambahkan pagination
        return view('admin.hero_sliders.index', compact('sliders'));
    }

    /**
     * Tampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        // Validasi: Maksimal 5 slider aktif
        $activeSlidersCount = HeroSlider::where('is_active', true)->count();
        if ($activeSlidersCount >= 5) {
            return redirect()->route('admin.hero-sliders.index') // Perhatikan nama rute yang di-prefix
                ->with('error', 'Anda hanya dapat memiliki maksimal 5 slider hero yang aktif.');
        }
        return view('admin.hero_sliders.create');
    }

    /**
     * Simpan sumber daya yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000', // Validasi gambar
            'is_active' => 'nullable|boolean', // Nullable karena checkbox tidak akan ada di request jika tidak dicentang
            'order' => 'nullable|integer',
        ]);

        // Cek lagi batasan 5 slider aktif jika 'is_active' dicentang
        $newIsActive = $request->has('is_active') ? $request->boolean('is_active') : false;
        if ($newIsActive) { // Hanya cek jika mencoba mengaktifkan
            $activeSlidersCount = HeroSlider::where('is_active', true)->count();
            if ($activeSlidersCount >= 5) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Tidak dapat mengaktifkan: Maksimal 5 slider hero aktif diizinkan.');
            }
        }

        // Simpan gambar ke storage/app/public/hero_sliders
        $imagePath = $request->file('image')->store('hero_sliders', 'public');

        HeroSlider::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => $newIsActive,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero Slider berhasil dibuat.');
    }

    /**
     * Tampilkan sumber daya yang ditentukan.
     */
    public function show(HeroSlider $heroSlider)
    {
        return view('admin.hero_sliders.show', compact('heroSlider'));
    }

    /**
     * Tampilkan formulir untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(HeroSlider $heroSlider)
    {
        return view('admin.hero_sliders.edit', compact('heroSlider'));
    }

    /**
     * Perbarui sumber daya yang ditentukan di penyimpanan.
     */
    public function update(Request $request, HeroSlider $heroSlider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10048', // Gambar opsional saat update
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $newIsActive = $request->has('is_active') ? $request->boolean('is_active') : false;

        // Cek jika mencoba mengaktifkan dan sudah ada 5 slider aktif lainnya
        // Atau jika slider ini sebelumnya tidak aktif dan sekarang akan diaktifkan
        if ($newIsActive && !$heroSlider->is_active) {
            $activeSlidersCount = HeroSlider::where('is_active', true)->where('id', '!=', $heroSlider->id)->count();
            if ($activeSlidersCount >= 5) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Tidak dapat mengaktifkan: Maksimal 5 slider hero aktif diizinkan.');
            }
        }

        $imagePath = $heroSlider->image;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($heroSlider->image && Storage::disk('public')->exists($heroSlider->image)) {
                Storage::disk('public')->delete($heroSlider->image);
            }
            $imagePath = $request->file('image')->store('hero_sliders', 'public');
        }

        $heroSlider->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => $newIsActive,
            'order' => $request->order,
        ]);

        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero Slider berhasil diperbarui.');
    }

    /**
     * Hapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(HeroSlider $heroSlider)
    {
        $heroSlider->delete();
        return redirect()->route('admin.hero-sliders.index')->with('success', 'Hero Slider berhasil dihapus.');
    }
}