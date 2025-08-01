<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Album Galeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Album</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('name', $gallery->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi
                                (Opsional)</label>
                            <input type="text" name="description" id="description" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                value="{{ old('description', $gallery->description) }}">
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
                                @if ($gallery->cover_image)
                                    <img id="cover-image-preview" src="{{ Storage::url($gallery->cover_image) }}"
                                        alt="Pratinjau Sampul" class="h-32 w-auto object-cover rounded-md block">
                                @else
                                    <img id="cover-image-preview" src="#" alt="Pratinjau Sampul"
                                        class="hidden h-32 w-auto object-cover rounded-md">
                                @endif
                            </div>
                        </div>

                        <div class="mb-4 flex items-center">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                class="rounded border-gray-300 text-desa-green shadow-sm focus:border-desa-green focus:ring focus:ring-desa-green focus:ring-opacity-50"
                                {{ old('is_published', $gallery->is_published) ? 'checked' : '' }}>
                            <label for="is_published" class="ml-2 block text-sm font-medium text-gray-700">Publikasikan
                                Album</label>
                            @error('is_published')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <h3 class="text-lg font-semibold mt-8 mb-4">Gambar-gambar di Album Ini</h3>
                        <div id="existing-images-fields" class="space-y-4">
                            @forelse ($gallery->images as $image)
                                <div class="existing-image-item p-4 border rounded-md relative"
                                    id="image-item-{{ $image->id }}">
                                    <input type="hidden" name="existing_image_ids[]" value="{{ $image->id }}">
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                        <img src="{{ Storage::url($image->path) }}" alt="Gambar Galeri"
                                            class="h-24 w-auto object-cover rounded-md mt-1">
                                        {{-- Opsi untuk mengganti gambar lama --}}
                                        <input type="file" name="replace_images[{{ $image->id }}]"
                                            class="mt-1 block w-full" accept="image/*"
                                            onchange="previewImage(event, 'existing-image-preview-{{ $image->id }}')">
                                        <img id="existing-image-preview-{{ $image->id }}" src="#"
                                            alt="Pratinjau Gambar Baru"
                                            class="hidden h-24 w-auto object-cover rounded-md mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label class="block text-sm font-medium text-gray-700">Keterangan</label>
                                        <input type="text" name="existing_captions[{{ $image->id }}]"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                            value="{{ old('existing_captions.' . $image->id, $image->caption) }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Urutan</label>
                                        <input type="number" name="existing_order[{{ $image->id }}]"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                            value="{{ old('existing_order.' . $image->id, $image->order) }}">
                                    </div>
                                    <button type="button"
                                        class="remove-existing-image-field absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs"
                                        data-image-id="{{ $image->id }}">&times;</button>
                                </div>
                            @empty
                                <p class="text-gray-500">Tidak ada gambar di album ini.</p>
                            @endforelse
                        </div>

                        <h3 class="text-lg font-semibold mt-8 mb-4">Tambahkan Gambar Baru</h3>
                        <div id="new-image-upload-fields" class="space-y-4">
                            {{-- Initial empty field for new images --}}
                            <div class="new-image-upload-item p-4 border rounded-md">
                                <div class="mb-2">
                                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                                    <input type="file" name="images[]" class="mt-1 block w-full" accept="image/*"
                                        onchange="previewImage(event, 'new-image-preview-0')">
                                    <img id="new-image-preview-0" src="#" alt="Pratinjau Gambar"
                                        class="hidden h-24 w-auto object-cover rounded-md mt-2">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Keterangan
                                        (Opsional)</label>
                                    <input type="text" name="captions[]"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-new-image-field"
                            class="mt-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                            Tambah Gambar Baru Lain
                        </button>

                        <div class="flex items-center justify-end mt-8">
                            <a href="{{ route('admin.galleries.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                            <button type="submit"
                                class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                                Perbarui Album
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let newImageCounter = 0; // Separate counter for new images

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

        // Add new image field
        document.getElementById('add-new-image-field').addEventListener('click', function() {
            newImageCounter++;
            const container = document.getElementById('new-image-upload-fields');
            const newItem = document.createElement('div');
            newItem.classList.add('new-image-upload-item', 'p-4', 'border', 'rounded-md', 'relative');
            newItem.innerHTML = `
                <div class="mb-2">
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="images[]" class="mt-1 block w-full" accept="image/*" onchange="previewImage(event, 'new-image-preview-${newImageCounter}')">
                    <img id="new-image-preview-${newImageCounter}" src="#" alt="Pratinjau Gambar" class="hidden h-24 w-auto object-cover rounded-md mt-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Keterangan (Opsional)</label>
                    <input type="text" name="captions[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                </div>
                <button type="button" class="remove-new-image-field absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs">&times;</button>
            `;
            container.appendChild(newItem);

            // Add event listener for removing new field
            newItem.querySelector('.remove-new-image-field').addEventListener('click', function() {
                newItem.remove();
            });
        });

        // Handle removing existing images using AJAX or hidden input for deletion
        document.querySelectorAll('.remove-existing-image-field').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.dataset.imageId;
                if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                    // Option 1: Mark for deletion via hidden input on form submission
                    const form = this.closest('form');
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'deleted_images[]';
                    hiddenInput.value = imageId;
                    form.appendChild(hiddenInput);

                    // Visually remove the item from the page
                    document.getElementById(`image-item-${imageId}`).remove();

                    // Option 2 (AJAX): You could make an AJAX call here to delete immediately
                    // This example uses Option 1 (mark for deletion on form submit)
                }
            });
        });
    </script>
</x-admin-layout>
