<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Galeri Foto Desa Orakeri') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-accent text-center" data-aos="fade-down">Album Galeri Kami
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($galleries as $index => $gallery)
                            <div class="mb-4 p-4 border rounded-lg shadow-md" data-aos="fade-up"
                                data-aos-delay="{{ 100 * ($index + 1) }}">
                                <a href="{{ route('gallery.show', $gallery->slug) }}" class="block group">
                                    @if ($gallery->cover_image)
                                        <img src="{{ Storage::url($gallery->cover_image) }}"
                                            alt="Sampul {{ $gallery->name }}"
                                            class="w-full h-48 object-cover rounded-lg shadow-md mb-3 transform hover:scale-105 transition duration-500">
                                    @elseif ($gallery->images->isNotEmpty())
                                        <img src="{{ Storage::url($gallery->images->first()->path) }}"
                                            alt="Sampul {{ $gallery->name }}"
                                            class="w-full h-48 object-cover rounded-lg shadow-md mb-3 transform hover:scale-105 transition duration-500">
                                    @else
                                        <div
                                            class="w-full h-48 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg mb-3">
                                            Tidak ada Gambar</div>
                                    @endif
                                    <h4 class="text-xl font-bold text-desa-green mb-2">{{ $gallery->name }}</h4>
                                    <p class="text-gray-700 text-sm">{{ Str::limit($gallery->description, 100) }}</p>
                                    <p class="text-gray-600 text-xs mt-2">{{ $gallery->images->count() }} Foto</p>
                                    <span
                                        class="mt-3 inline-block bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-sm">Lihat
                                        Album &rarr;</span>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada album galeri yang
                                dipublikasikan.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $galleries->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Lightbox Integration (Optional but Recommended for Galleries) --}}
    {{-- Untuk membuat gambar pop-up saat diklik, Anda perlu menambahkan library lightbox JS/CSS terpisah. --}}
    {{-- Contoh: GLightbox, Featherlight, Lightbox2. Pastikan file JS/CSS nya diimport di app.js/app.css --}}
</x-app-layout>
