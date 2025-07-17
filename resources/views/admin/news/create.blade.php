<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Konten Berita</label>
                            <textarea name="content" id="content" rows="10"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Gambar
                                (Opsional)</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full"
                                accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mt-2" id="image-preview-container">
                                <img id="image-preview" src="#" alt="Pratinjau Gambar"
                                    class="hidden h-32 w-auto object-cover rounded-md">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Penulis
                                (Opsional)</label>
                            <input type="text" name="author" id="author"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('author', Auth::user()->name ?? '') }}">
                            @error('author')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="published_at" class="block text-sm font-medium text-gray-700">Tanggal Publikasi
                                (Opsional)</label>
                            <input type="datetime-local" name="published_at" id="published_at"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            @error('published_at')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50"
                                {{ old('is_published', true) ? 'checked' : '' }}>
                            <label for="is_published"
                                class="ml-2 block text-sm font-medium text-gray-700">Publikasikan</label>
                            @error('is_published')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.news.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
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
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
                output.classList.remove('hidden');
                output.classList.add('block');
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                document.getElementById('image-preview').classList.add('hidden');
                document.getElementById('image-preview').src = '#';
            }
        }
    </script>
</x-admin-layout>
