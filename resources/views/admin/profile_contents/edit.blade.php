<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Konten Profil: ') . $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile-contents.update', $key) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Konten
                                {{ $title }}</label>
                            @if ($key == 'Maps_embed')
                                <input type="url" name="content" id="content"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                    value="{{ old('content', $content->content) }}"
                                    placeholder="Contoh: https://www.google.com/maps/embed?pb=..." required>
                                <p class="mt-1 text-sm text-gray-500">Masukkan URL embed Google Maps di sini.</p>
                            @else
                                {{-- Gunakan textarea untuk konten panjang (visi, misi, sejarah, dll.) --}}
                                {{-- Gunakan rows yang lebih sedikit jika ini untuk teks singkat seperti alamat --}}
                                @php
                                    $textareaRows = 15; // Default untuk konten panjang
                                    if (
                                        in_array($key, [
                                            'contact_address',
                                            'contact_phone',
                                            'contact_email',
                                            'footer_about',
                                        ])
                                    ) {
                                        $textareaRows = 5; // Untuk teks singkat
                                    }
                                @endphp
                                <textarea name="content" id="content" rows="{{ $textareaRows }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('content', $content->content) }}</textarea>

                                {{-- Panggil TinyMCE untuk textarea ini --}}
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        if (typeof initializeTinyMCE !== 'undefined' && document.getElementById('content')) {
                                            // Hapus instance TinyMCE sebelumnya jika ada
                                            if (tinymce.get('content')) {
                                                tinymce.get('content').remove();
                                            }
                                            initializeTinyMCE('textarea#content');
                                        }
                                    });
                                </script>
                            @endif
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
