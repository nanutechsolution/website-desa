<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Umum & Info Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update-general-info') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Helper function to render a setting field --}}
                        @php
                            function renderSettingField($setting, $key, $errors) {
                                // Pastikan nilai default jika $setting->content null
                                $currentContent = old($key . '_content', $setting->content ?? '');
                                $currentTitle = old($key . '_title', $setting->title ?? Str::title(str_replace('_', ' ', $key)));
                                $currentType = old($key . '_type', $setting->type ?? 'text'); // Default ke 'text'
                                $currentIsPublished = old($key . '_is_published', $setting->is_published ?? true);
                        @endphp

                                <div class="mb-6 border-b pb-4 last:border-b-0" x-data="{ type: '{{ $currentType }}', isPublished: {{ $currentIsPublished ? 'true' : 'false' }} }">
                                    <h3 class="text-lg font-semibold text-desa-green mb-3">
                                        {{ $currentTitle }}
                                        <span class="text-sm font-normal text-gray-500">({{ Str::title(str_replace('_', ' ', $key)) }})</span>
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label for="{{ $key }}_title" class="block text-sm font-medium text-gray-700">Nama Tampilan</label>
                                            <input type="text" name="{{ $key }}_title" id="{{ $key }}_title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $currentTitle }}" required>
                                            @error($key . '_title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label for="{{ $key }}_type" class="block text-sm font-medium text-gray-700">Tipe Konten</label>
                                            <select name="{{ $key }}_type" id="{{ $key }}_type" x-model="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                                <option value="text">Teks Biasa</option>
                                                <option value="richtext">Teks Kaya (WYSIWYG)</option>
                                                <option value="url">URL (Link)</option>
                                                <option value="image">Gambar (File Upload)</option>
                                            </select>
                                            @error($key . '_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    
                                    {{-- Konten Input Dinamis --}}
                                    <div class="mt-4" x-init="
                                        $watch('type', (value) => {
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
                                        }
                                    ">
                                        <label for="{{ $key }}_content" class="block text-sm font-medium text-gray-700">Isi Konten</label>
                                        <template x-if="type === 'richtext'">
                                            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $currentContent }}</textarea>
                                        </template>
                                        <template x-if="type === 'text'">
                                            <textarea name="{{ $key }}_content" id="{{ $key }}_content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $currentContent }}</textarea>
                                        </template>
                                        <template x-if="type === 'url'">
                                            <input type="url" name="{{ $key }}_content" id="{{ $key }}_content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $currentContent }}" placeholder="https://example.com/link">
                                        </template>
                                        <template x-if="type === 'image'">
                                            <div>
                                                <input type="file" name="{{ $key }}_content" id="{{ $key }}_content_file" class="mt-1 block w-full" accept="image/*" onchange="previewImage(event, '{{ $key }}-preview')">
                                                @if($setting->type === 'image' && $setting->content)
                                                    <img id="{{ $key }}-preview" src="{{ $setting->image_url }}" alt="Gambar Saat Ini" class="h-24 w-auto object-cover rounded-md mt-2">
                                                    <div class="mt-2 flex items-center">
                                                        <input type="checkbox" name="remove_{{ $key }}_content" id="remove_{{ $key }}_content" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                                                        <label for="remove_{{ $key }}_content" class="ml-2 text-sm text-gray-600">Hapus Gambar Saat Ini</label>
                                                    </div>
                                                @else
                                                    <img id="{{ $key }}-preview" src="{{ asset('images/placeholder-image.png') }}" alt="Pratinjau Gambar" class="hidden h-24 w-auto object-cover rounded-md mt-2">
                                                @endif
                                            </div>
                                        </template>
                                    </div>
                                    {{-- Checkbox Publikasi --}}
                                    <div class="mt-4 flex items-center">
                                        <input type="hidden" name="{{ $key }}_is_published" value="0">
                                        <input type="checkbox" name="{{ $key }}_is_published" id="{{ $key }}_is_published" value="1" x-model="isPublished" class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50">
                                        <label for="{{ $key }}_is_published" class="ml-2 block text-sm font-medium text-gray-700">Publikasikan Konten</label>
                                        @error($key . '_is_published')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                        @php
                            } // End of renderSettingField function
                        @endphp

                        {{-- Panggil Field untuk Setiap Pengaturan --}}
                        <h3 class="text-lg font-semibold text-dark-text mb-4">Pengaturan Situs Utama</h3>
                        {{ renderSettingField($settings['village_name'], 'village_name', $errors) }}
                        {{ renderSettingField($settings['site_meta_description'], 'site_meta_description', $errors) }}
                        {{ renderSettingField($settings['site_logo'], 'site_logo', $errors) }}
                        
                        <h3 class="text-lg font-semibold text-dark-text mb-4 mt-6">Informasi Kontak & Lokasi</h3>
                        {{-- Menggunakan renderSettingField untuk koordinat gabungan --}}
                        @php
                            // Buat objek dummy untuk koordinat gabungan
                            $combinedCoordsContent = (object)['content' => '', 'title' => 'Koordinat Google Maps'];
                            if($settings['Maps_latitude']->content && $settings['Maps_longitude']->content){
                                $combinedCoordsContent->content = $settings['Maps_latitude']->content . ', ' . $settings['Maps_longitude']->content;
                            }
                            $combinedCoordsContent->type = 'text'; // Tipe untuk input ini
                            $combinedCoordsContent->is_published = true; // Anggap selalu dipublikasikan
                        @endphp
                        {{ renderSettingField($combinedCoordsContent, 'Maps_coords_combined', $errors) }}
                        
                        {{ renderSettingField($settings['contact_address'], 'contact_address', $errors) }}
                        {{ renderSettingField($settings['contact_phone'], 'contact_phone', $errors) }}
                        {{ renderSettingField($settings['contact_email'], 'contact_email', $errors) }}
                        
                        <h3 class="text-lg font-semibold text-dark-text mb-4 mt-6">Konten Lainnya</h3>
                        {{ renderSettingField($settings['footer_about'], 'footer_about', $errors) }}

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit" class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk preview gambar (di luar renderSettingField) --}}
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById(previewId);
                output.src = reader.result;
                output.classList.remove('hidden');
                output.classList.add('block');
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                document.getElementById(previewId).classList.add('hidden');
                document.getElementById(previewId).src = '#';
            }
        }
    </script>
</x-admin-layout>