<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Manajemen Hero Slider') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 sm:mb-0">Daftar Siswa</h3>
                        <a href="{{ route('admin.hero-sliders.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                            <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tambah Slider
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
                    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6"> Gambar
                                    </th>
                                    <th scope="col" class="py-3 px-6"> Judul
                                    </th>
                                    <th scope="col" class="py-3 px-6"> Deskripsi
                                    </th>
                                    <th scope="col" class="py-3 px-6"> Aktif
                                    </th>
                                    <th scope="col" class="py-3 px-6"> Urutan
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($sliders as $slider)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                            @if ($slider->image)
                                                <img src="{{ Storage::url($slider->image) }}" alt="{{ $slider->title }}"
                                                    class="h-16 w-16 object-cover rounded-md">
                                            @else
                                                N/A
                                            @endif
                                        </th>
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ Str::limit($slider->title, 10) }}</td>
                                        <td class="py-4 px-6">

                                            {{ Str::limit($slider->description, 50) }}</td>
                                        <td class="py-4 px-6">

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
                                        <td class="py-4 px-6">
                                            {{ $slider->order ?? '-' }}</td>
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
                    <div class="mt-4">
                        {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
</x-admin-layout>
