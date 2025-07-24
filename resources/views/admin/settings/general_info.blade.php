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
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update-general-info') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Logika renderSettingField SUDAH DI DALAM PARTIAL _setting_field.blade.php --}}
                        {{-- Ini adalah panggilan ke partial tersebut --}}

                        {{-- Panggil Field untuk Setiap Pengaturan --}}
                        <h3 class="text-lg font-semibold text-dark-text mb-4">Pengaturan Situs Utama</h3>
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['village_name'],
                            'key' => 'village_name',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['site_meta_description'],
                            'key' => 'site_meta_description',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['site_logo'],
                            'key' => 'site_logo',
                            'errors' => $errors,
                        ])

                        <h3 class="text-lg font-semibold text-dark-text mb-4 mt-6">Warna Branding</h3>
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['brand_primary_color_hsl'],
                            'key' => 'brand_primary_color_hsl',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['brand_secondary_color_hsl'],
                            'key' => 'brand_secondary_color_hsl',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['brand_accent_color_hsl'],
                            'key' => 'brand_accent_color_hsl',
                            'errors' => $errors,
                        ])

                        <h3 class="text-lg font-semibold text-dark-text mb-4 mt-6">Informasi Kontak & Lokasi</h3>
                        @php
                            // Buat objek dummy untuk koordinat gabungan (tetap di sini karena ini logika spesifik untuk menggabungkan dua setting menjadi satu input)
                            $combinedCoordsContent = (object) ['content' => '', 'title' => 'Koordinat Google Maps'];
                            if (
                                isset($settings['Maps_latitude']->content) &&
                                isset($settings['Maps_longitude']->content)
                            ) {
                                $combinedCoordsContent->content =
                                    $settings['Maps_latitude']->content . ', ' . $settings['Maps_longitude']->content;
                            }
                            $combinedCoordsContent->type = 'text';
                            $combinedCoordsContent->is_published = true;
                        @endphp
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $combinedCoordsContent,
                            'key' => 'Maps_coords_combined',
                            'errors' => $errors,
                        ])

                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['contact_address'],
                            'key' => 'contact_address',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['contact_phone'],
                            'key' => 'contact_phone',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['contact_email'],
                            'key' => 'contact_email',
                            'errors' => $errors,
                        ])

                        <h3 class="text-lg font-semibold text-dark-text mb-4 mt-6">Konten Lainnya</h3>
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['footer_about'],
                            'key' => 'footer_about',
                            'errors' => $errors,
                        ])

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk preview gambar (ini tetap di sini, di luar fungsi renderSettingField) --}}
    <script>
        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
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
