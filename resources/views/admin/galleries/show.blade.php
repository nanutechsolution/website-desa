<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Album Galeri: ') . $gallery->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-2">Nama Album: {{ $gallery->name }}</h3>
                        <p class="text-gray-700 mb-2">Deskripsi: {{ $gallery->description ?? '-' }}</p>
                        <p class="text-gray-700 mb-2">Status:
                            @if ($gallery->is_published)
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-desa-green text-white">Publikasi</span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Draft</span>
                            @endif
                        </p>
                        @if ($gallery->cover_image)
                            <div class="mt-4">
                                <p class="text-gray-700 mb-2">Gambar Sampul:</p>
                                <img src="{{ Storage::url($gallery->cover_image) }}" alt="Sampul Album"
                                    class="max-w-xs h-auto object-cover rounded-md shadow">
                            </div>
                        @endif
                    </div>

                    <h4 class="text-lg font-semibold mt-8 mb-4">Gambar-gambar dalam Album Ini:</h4>
                    @forelse ($gallery->images as $image)
                        <div class="mb-4 p-4 border rounded-md flex items-center space-x-4">
                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->caption ?? 'Gambar Galeri' }}"
                                class="h-24 w-auto object-cover rounded-md shadow">
                            <div>
                                <p class="font-medium">Keterangan: {{ $image->caption ?? '-' }}</p>
                                <p class="text-sm text-gray-600">Urutan: {{ $image->order ?? '-' }}</p>
                            </div>
                            {{-- Tombol hapus gambar ini akan memanggil route deleteImage terpisah --}}
                            <form action="{{ route('admin.galleries.delete-image', $image->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="ml-auto bg-red-500 hover:bg-red-700 text-white text-xs py-1 px-2 rounded">Hapus
                                    Gambar</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500">Tidak ada gambar di album ini.</p>
                    @endforelse

                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('admin.galleries.edit', $gallery) }}"
                            class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md mr-3">Edit
                            Album</a>
                        <a href="{{ route('admin.galleries.index') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
