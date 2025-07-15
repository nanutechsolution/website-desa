<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Album Galeri Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Album</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                                (Opsional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Sampul Album
                                (Opsional)</label>
                            <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full"
                                accept="image/*" onchange="previewImage(event, 'cover-image-preview')">
                            @error('cover_image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mt-2">
                                <img id="cover-image-preview" src="#" alt="Pratinjau Sampul"
                                    class="hidden h-32 w-auto object-cover rounded-md">
                            </div>
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50"
                                {{ old('is_published', true) ? 'checked' : '' }}>
                            <label for="is_published" class="ml-2 block text-sm font-medium text-gray-700">Publikasikan
                                Album</label>
                            @error('is_published')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <h3 class="text-lg font-semibold mt-8 mb-4">Tambahkan Gambar ke Album Ini</h3>
                        <div id="image-upload-fields" class="space-y-4">
                            <div class="image-upload-item p-4 border rounded-md">
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                    <input type="file" name="images[]" class="mt-1 block w-full" accept="image/*"
                                        onchange="previewImage(event, 'image-preview-0')">
                                    <img id="image-preview-0" src="#" alt="Pratinjau Gambar"
                                        class="hidden h-24 w-auto object-cover rounded-md mt-2">
                                    @error('images.0')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
                                    <input type="text" name="captions[]"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                    @error('captions.0')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-image-field"
                            class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                            Tambah Gambar Lain
                        </button>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('admin.galleries.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Buat Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let imageCounter = 0;

        function previewImage(event, previewId) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById(previewId);
                output.src = reader.result;
                output.classList.remove('hidden');
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                document.getElementById(previewId).classList.add('hidden');
                document.getElementById(previewId).src = '#';
            }
        }

        document.getElementById('add-image-field').addEventListener('click', function() {
            imageCounter++;
            const container = document.getElementById('image-upload-fields');
            const newItem = document.createElement('div');
            newItem.classList.add('image-upload-item', 'p-4', 'border', 'rounded-md', 'relative');
            newItem.innerHTML = `
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="images[]" class="mt-1 block w-full" accept="image/*" onchange="previewImage(event, 'image-preview-${imageCounter}')">
                    <img id="image-preview-${imageCounter}" src="#" alt="Pratinjau Gambar" class="hidden h-24 w-auto object-cover rounded-md mt-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
                    <input type="text" name="captions[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                </div>
                <button type="button" class="remove-image-field absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">&times;</button>
            `;
            container.appendChild(newItem);

            // Add event listener for removing new field
            newItem.querySelector('.remove-image-field').addEventListener('click', function() {
                newItem.remove();
            });
        });

        // Initial check for any old input images if validation fails
        // This part might need data from old() helper if form submission fails
        // For simplicity, we assume successful uploads for newly added fields.
    </script>
</x-admin-layout>
