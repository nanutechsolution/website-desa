@props(['index'])

<div class="image-upload-item p-4 border border-gray-300 dark:border-gray-600 rounded-md relative">
    <div class="mb-2">
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gambar</label>
        <input type="file" name="images[]" accept="image/*"
            onchange="previewImage(event, 'image-preview-{{ $index }}')"
            class="mt-1 block w-full text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900 rounded-md border-gray-300 dark:border-gray-600 shadow-sm" />
        <img id="image-preview-{{ $index }}" src="#" alt="Pratinjau Gambar"
            class="hidden h-24 w-auto object-cover rounded-md mt-2" />
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan (Opsional)</label>
        <input type="text" name="captions[]"
            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 shadow-sm" />
    </div>
    <button type="button"
        class="remove-image-field absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white rounded-full h-6 w-6 flex items-center justify-center text-xs"
        onclick="this.closest('.image-upload-item').remove();">&times;</button>
</div>
