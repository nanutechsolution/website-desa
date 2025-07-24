<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Tambah Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors">
                {{-- Latar belakang card utama --}}
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors"> {{-- Warna teks konten utama --}}
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Judul</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Konten
                                Berita</label>
                            <textarea name="content" id="content" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Gambar
                                (Opsional)</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full
                                       text-gray-900 dark:text-gray-200
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-md file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-desa-skyblue
                                       hover:file:bg-blue-100 dark:file:bg-gray-600 dark:file:text-gray-200 dark:hover:file:bg-gray-500
                                       cursor-pointer transition-colors"
                                accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mt-2" id="image-preview-container">
                                <img id="image-preview" src="#" alt="Pratinjau Gambar"
                                    class="hidden h-32 w-auto object-cover rounded-md shadow-md"> {{-- Menambahkan shadow --}}
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="author"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Penulis
                                (Opsional)</label>
                            <input type="text" name="author" id="author"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('author', Auth::user()->name ?? '') }}">
                            @error('author')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="published_at"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Tanggal
                                Publikasi
                                (Opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                       bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200
                                       focus:border-desa-skyblue dark:focus:border-blue-500 focus:ring focus:ring-desa-skyblue dark:focus:ring-blue-500 focus:ring-opacity-50
                                       transition-colors"
                                value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            @error('published_at')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                class="rounded border-gray-300 dark:border-gray-600
                                       text-desa-green dark:text-green-500
                                       shadow-sm
                                       focus:border-desa-green dark:focus:border-green-600
                                       focus:ring focus:ring-desa-green dark:focus:ring-green-600 focus:ring-opacity-50
                                       transition-colors"
                                {{ old('is_published', true) ? 'checked' : '' }}>
                            <label for="is_published"
                                class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300 transition-colors">Publikasikan</label>
                            @error('is_published')
                                <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6"> {{-- Margin-top ditingkatkan --}}
                            <a href="{{ route('admin.news.index') }}"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200 mr-4 transition-colors">Batal</a>
                            <button type="submit"
                                class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                       transition-colors duration-200">
                                Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const output = document.getElementById('image-preview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    output.src = reader.result;
                    output.classList.remove('hidden');
                    output.classList.add('block');
                };
                reader.readAsDataURL(file);
            } else {
                // If no file is selected (e.g., user cancels file dialog), hide the preview
                output.classList.add('hidden');
                output.classList.remove('block'); // Ensure 'block' is removed
                output.src = '#'; // Reset src
            }
        }
    </script>
</x-admin-layout>
