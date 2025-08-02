@php
    $currentContent = old($key . '_content', $setting->content ?? '');
    $currentTitle = old($key . '_title', $setting->title ?? Str::title(str_replace('_', ' ', $key)));
    $currentType = old($key . '_type', $setting->type ?? 'text');
    $currentIsPublished = old($key . '_is_published', $setting->is_published ?? true);

    $colorPalette = [
        '#4CAF50',
        '#388E3C',
        '#1B5E20',
        '#2196F3',
        '#1976D2',
        '#0D47A1',
        '#795548',
        '#5D4037',
        '#3E2723',
        '#FFC107',
        '#FF9800',
        '#FF5722',
    ];
@endphp

<div class="mb-6 border-b dark:border-gray-700 pb-4 last:border-b-0" x-data="{ type: '{{ $currentType }}', isPublished: {{ $currentIsPublished ? 'true' : 'false' }}, colorValue: '{{ $currentContent }}' }">
    <h3 class="text-lg font-semibold text-primary dark:text-primary-dark mb-3">
        {{ $currentTitle }}
        <span
            class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ Str::title(str_replace('_', ' ', $key)) }})</span>
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="{{ $key }}_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                Tampilan</label>
            <input type="text" name="{{ $key }}_title" id="{{ $key }}_title"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm"
                value="{{ $currentTitle }}" required readonly>
            @error($key . '_title')
                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="{{ $key }}_type"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipe Konten</label>
            <select name="{{ $key }}_type" id="{{ $key }}_type" x-model="type"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm">
                <option value="text">Teks Biasa</option>
                <option value="richtext">Teks Kaya (WYSIWYG)</option>
                <option value="url">URL (Link)</option>
                <option value="image">Gambar (File Upload)</option>
                <option value="color">Warna (HEX Code)</option>
            </select>
            @error($key . '_type')
                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Konten Dinamis --}}
    <div class="mt-4" x-init="...">
        <label for="{{ $key }}_content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Isi
            Konten</label>

        <template x-if="type === 'richtext'">
            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="10"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm">{{ $currentContent }}</textarea>
        </template>

        <template x-if="type === 'text'">
            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm">{{ $currentContent }}</textarea>
        </template>

        <template x-if="type === 'url'">
            <input type="url" name="{{ $key }}_content" id="{{ $key }}_content"
                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white shadow-sm"
                value="{{ $currentContent }}" placeholder="https://example.com/link">
        </template>

        <template x-if="type === 'image'">
            <div>
                <input type="file" name="{{ $key }}_content" id="{{ $key }}_content_file"
                    class="mt-1 block w-full dark:text-gray-200 dark:bg-gray-900 dark:border-gray-600" accept="image/*"
                    onchange="previewImage(event, '{{ $key }}-preview')">
                @if ($setting->type === 'image' && $setting->content)
                    <img id="{{ $key }}-preview" src="{{ $setting->image_url }}" alt="Gambar Saat Ini"
                        class="h-24 w-auto object-cover rounded-md mt-2 border dark:border-gray-700">
                    <div class="mt-2 flex items-center">
                        <input type="checkbox" name="remove_{{ $key }}_content"
                            id="remove_{{ $key }}_content" value="1"
                            class="rounded border-gray-300 dark:border-gray-600 text-red-600 shadow-sm focus:ring-red-500">
                        <label for="remove_{{ $key }}_content"
                            class="ml-2 text-sm text-gray-600 dark:text-gray-300">Hapus Gambar Saat Ini</label>
                    </div>
                @else
                    <img id="{{ $key }}-preview" src="{{ asset('images/placeholder-image.png') }}"
                        alt="Pratinjau Gambar"
                        class="hidden h-24 w-auto object-cover rounded-md mt-2 border dark:border-gray-700">
                @endif
            </div>
        </template>

        <template x-if="type === 'color'">
            <div>
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($colorPalette as $color)
                        <button type="button" @click="colorValue = '{{ $color }}'"
                            class="w-8 h-8 rounded-full border border-gray-300 dark:border-gray-600"
                            style="background-color: {{ $color }};" title="{{ $color }}">
                        </button>
                    @endforeach
                </div>
                <input type="color" name="{{ $key }}_content" id="{{ $key }}_content"
                    x-model="colorValue"
                    class="mt-1 block w-full h-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Pilih dari palet atau masukkan HEX (misal:
                    #4CAF50).</p>
            </div>
        </template>
    </div>

    <div class="mt-4 flex items-center">
        <input type="hidden" name="{{ $key }}_is_published" value="0">
        <input type="checkbox" name="{{ $key }}_is_published" id="{{ $key }}_is_published"
            value="1" x-model="isPublished"
            class="rounded border-gray-300 dark:border-gray-600 text-primary shadow-sm focus:ring focus:ring-primary-dark focus:ring-opacity-50">
        <label for="{{ $key }}_is_published"
            class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
            Publikasikan Konten
        </label>
        @error($key . '_is_published')
            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
