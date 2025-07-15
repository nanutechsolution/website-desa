<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manajemen Hero Slider') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="bg-white overflow-auto shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.hero-sliders.create') }}"
                        class="bg-desa-green hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Tambah Slider Baru
                    </a>
                </div>
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
                <div class="overflow-x-auto">
                    <div class="inline-block min-w-full align-middle">
                        <table class="table-auto">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gambar
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Judul
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aktif
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Urutan
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($sliders as $slider)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($slider->image)
                                                <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}"
                                                    class="h-16 w-16 object-cover rounded-md">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ Str::limit($slider->title, 10) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ Str::limit($slider->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($slider->is_active)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-desa-green text-white">
                                                    Ya
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Tidak
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $slider->order ?? '-' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.hero-sliders.edit', $slider) }}"
                                                class="text-desa-skyblue hover:text-blue-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.hero-sliders.destroy', $slider) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada
                                            slider
                                            hero ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mt-4">
                    {{ $sliders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
