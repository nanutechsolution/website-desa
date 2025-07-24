@php

    $currentContent = old($key . '_content', $setting->content ?? '');
    $currentTitle = old($key . '_title', $setting->title ?? Str::title(str_replace('_', ' ', $key)));
    $currentType = old($key . '_type', $setting->type ?? 'text'); // Default ke 'text'
    $currentIsPublished = old($key . '_is_published', $setting->is_published ?? true);

    // Palet warna yang direkomendasikan
    $colorPalette = [
        '#4CAF50',
        '#388E3C',
        '#1B5E20', // Hijau
        '#2196F3',
        '#1976D2',
        '#0D47A1', // Biru
        '#795548',
        '#5D4037',
        '#3E2723', // Coklat
        '#FFC107',
        '#FF9800',
        '#FF5722', // Kuning/Oranye/Merah
    ];
@endphp

<div class="mb-6 border-b pb-4 last:border-b-0" x-data="{ type: '{{ $currentType }}', isPublished: {{ $currentIsPublished ? 'true' : 'false' }}, colorValue: '{{ $currentContent }}' }">
    <h3 class="text-lg font-semibold text-desa-green mb-3">
        {{ $currentTitle }}
        <span class="text-sm font-normal text-gray-500">({{ Str::title(str_replace('_', ' ', $key)) }})</span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="{{ $key }}_title" class="block text-sm font-medium text-gray-700">Nama Tampilan</label>
            <input type="text" name="{{ $key }}_title" id="{{ $key }}_title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $currentTitle }}" required>
            @error($key . '_title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="{{ $key }}_type" class="block text-sm font-medium text-gray-700">Tipe Konten</label>
            <select name="{{ $key }}_type" id="{{ $key }}_type" x-model="type"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="text">Teks Biasa</option>
                <option value="richtext">Teks Kaya (WYSIWYG)</option>
                <option value="url">URL (Link)</option>
                <option value="image">Gambar (File Upload)</option>
                <option value="color">Warna (HEX Code)</option>
            </select>
            @error($key . '_type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Konten Input Dinamis --}}
    <div class="mt-4" x-init="$watch('type', (value) => {
        // Hapus instance TinyMCE sebelumnya jika ada
        if (tinymce.get('{{ $key }}_content')) {
            tinymce.get('{{ $key }}_content').remove();
        }
        // Inisialisasi ulang TinyMCE jika tipe baru adalah 'richtext'
        if (value === 'richtext' && typeof initializeTinyMCE !== 'undefined') {
            $nextTick(() => initializeTinyMCE('textarea#{{ $key }}_content'));
        }
    });
    // Inisialisasi TinyMCE saat pertama kali load jika tipenya richtext
    if (type === 'richtext' && typeof initializeTinyMCE !== 'undefined') {
        $nextTick(() => initializeTinyMCE('textarea#{{ $key }}_content'));
    }">
        <label for="{{ $key }}_content" class="block text-sm font-medium text-gray-700">Isi Konten</label>
        <template x-if="type === 'richtext'">
            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="10"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $currentContent }}</textarea>
        </template>
        <template x-if="type === 'text'">
            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $currentContent }}</textarea>
        </template>
        <template x-if="type === 'url'">
            <input type="url" name="{{ $key }}_content" id="{{ $key }}_content"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $currentContent }}"
                placeholder="https://example.com/link">
        </template>
        <template x-if="type === 'image'">
            <div>
                <input type="file" name="{{ $key }}_content" id="{{ $key }}_content_file"
                    class="mt-1 block w-full" accept="image/*"
                    onchange="previewImage(event, '{{ $key }}-preview')">
                @if ($setting->type === 'image' && $setting->content)
                    <img id="{{ $key }}-preview" src="{{ $setting->image_url }}" alt="Gambar Saat Ini"
                        class="h-24 w-auto object-cover rounded-md mt-2">
                    <div class="mt-2 flex items-center">
                        <input type="checkbox" name="remove_{{ $key }}_content"
                            id="remove_{{ $key }}_content" value="1"
                            class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                        <label for="remove_{{ $key }}_content" class="ml-2 text-sm text-gray-600">Hapus Gambar
                            Saat Ini</label>
                    </div>
                @else
                    <img id="{{ $key }}-preview" src="{{ asset('images/placeholder-image.png') }}"
                        alt="Pratinjau Gambar" class="hidden h-24 w-auto object-cover rounded-md mt-2">
                @endif
            </div>
        </template>
        <template x-if="type === 'color'">
            <div>
                {{-- Palet Warna --}}
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($colorPalette as $color)
                        <button type="button" @click="colorValue = '{{ $color }}'"
                            class="w-8 h-8 rounded-full border border-gray-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-desa-skyblue"
                            style="background-color: {{ $color }};" title="{{ $color }}">
                        </button>
                    @endforeach
                </div>
                {{-- Input Color Picker --}}
                <input type="color" name="{{ $key }}_content" id="{{ $key }}_content"
                    x-model="colorValue" class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm">
                <p class="mt-1 text-sm text-gray-500">Pilih dari palet atau gunakan pemilih warna di atas. Masukkan kode
                    HEX (misal: `#4CAF50`).</p>
            </div>
        </template>
    </div>
    {{-- Checkbox Publikasi --}}
    <div class="mt-4 flex items-center">
        <input type="hidden" name="{{ $key }}_is_published" value="0">
        <input type="checkbox" name="{{ $key }}_is_published" id="{{ $key }}_is_published"
            value="1" x-model="isPublished"
            class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50">
        <label for="{{ $key }}_is_published" class="ml-2 block text-sm font-medium text-gray-700">Publikasikan
            Konten</label>
        @error($key . '_is_published')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
