<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pengaturan Umum & Info Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- ALERT MESSAGES --}}
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-200 border border-green-400 text-green-800 dark:text-green-900 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 dark:bg-red-200 border border-red-400 text-red-800 dark:text-red-900 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update-general-info') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Pengaturan Situs Utama
                        </h3>
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

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 mt-6">Warna Branding</h3>
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

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 mt-6">Informasi Kontak &
                            Lokasi</h3>
                        @php
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
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 mt-6">Media Sosial</h3>
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['social_media_facebook'],
                            'key' => 'social_media_facebook',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['social_media_instagram'],
                            'key' => 'social_media_instagram',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['social_media_twitter'],
                            'key' => 'social_media_twitter',
                            'errors' => $errors,
                        ])
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['social_media_tiktok'],
                            'key' => 'social_media_tiktok',
                            'errors' => $errors,
                        ])

                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4 mt-6">Konten Lainnya</h3>
                        @include('admin.settings.partials._setting_field', [
                            'setting' => $settings['footer_about'],
                            'key' => 'footer_about',
                            'errors' => $errors,
                        ])

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white mr-4">Batal</a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-600 disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                                Simpan Pengaturan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS: Preview Gambar --}}
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
                const output = document.getElementById(previewId);
                output.classList.add('hidden');
                output.src = '#';
            }
        }
    </script>
</x-admin-layout>
