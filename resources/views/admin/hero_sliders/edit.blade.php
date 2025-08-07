<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('Edit Hero Slider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('error'))
                        <div class="bg-red-100 dark:bg-red-200 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.hero-sliders.update', $heroSlider) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul -->
                        <div class="mb-4">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Judul</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('title', $heroSlider->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                            <input type="text" name="description" id="description"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('description', $heroSlider->description) }}" required>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-4">
                            <label for="image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
                            <input type="file" name="image" id="image"
                                class="mt-1 block w-full text-gray-900 dark:text-white bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md"
                                accept="image/*" onchange="previewImage(event)">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <div class="mt-2" id="image-preview-container">
                                @if ($heroSlider->image)
                                    <img id="image-preview" src="{{ Storage::url($heroSlider->image) }}"
                                        alt="Gambar Saat Ini" class="h-32 w-auto object-cover rounded-md block">
                                @else
                                    <img id="image-preview" src="#" alt="Pratinjau Gambar"
                                        class="hidden h-32 w-auto object-cover rounded-md">
                                @endif
                            </div>
                        </div>

                        <!-- Aktif -->
                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                class="rounded border-gray-300 dark:border-gray-600 text-desa-green bg-white dark:bg-gray-700 shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50"
                                {{ old('is_active', $heroSlider->is_active) ? 'checked' : '' }}>
                            <label for="is_active"
                                class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</label>
                            @error('is_active')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div class="mb-4">
                            <label for="order"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Urutan
                                (opsional)</label>
                            <input type="number" name="order" id="order"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('order', $heroSlider->order) }}">
                            @error('order')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tombol -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.hero-sliders.index') }}"
                                class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white mr-4">Batal</a>
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-dark active:bg-primary-darker focus:outline-none focus:border-primary-darker focus:ring ring-primary-light disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview JS -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
                output.classList.remove('hidden');
                output.classList.add('block');
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-admin-layout>
