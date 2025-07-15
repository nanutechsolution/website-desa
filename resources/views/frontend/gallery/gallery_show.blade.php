<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Album Galeri: ') . $gallery->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-desa-brown text-center" data-aos="fade-down">
                        {{ $gallery->name }}</h3>
                    <p class="text-gray-700 mb-6 text-center" data-aos="fade-down" data-aos-delay="100">
                        {{ $gallery->description }}</p>

                    @if ($gallery->cover_image)
                        <img src="{{ Storage::url($gallery->cover_image) }}" alt="Sampul {{ $gallery->name }}"
                            class="w-full h-96 object-cover rounded-lg shadow-md mb-8" data-aos="zoom-in">
                    @endif

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($gallery->images as $index => $image)
                            <div class="relative overflow-hidden rounded-lg shadow-lg group" data-aos="fade-up"
                                data-aos-delay="{{ 100 * ($index + 1) }}">
                                <img src="{{ Storage::url($image->path) }}"
                                    alt="{{ $image->caption ?? $gallery->name }}"
                                    class="w-full h-48 object-cover transform transition-transform duration-300 group-hover:scale-105">
                                <div
                                    class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    {{-- Untuk lightbox, Anda perlu menyertakan library JS terpisah (misal: GLightbox) --}}
                                    <a href="{{ Storage::url($image->path) }}"
                                        data-gallery="gallery-{{ $gallery->slug }}"
                                        data-glightbox="title: {{ $image->caption ?? $gallery->name }}"
                                        class="text-white text-3xl hover:scale-110 transform transition-transform duration-300">🔍</a>
                                </div>
                                @if ($image->caption)
                                    <div
                                        class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs px-2 py-1 truncate">
                                        {{ $image->caption }}</div>
                                @endif
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada gambar di album ini.</p>
                        @endforelse
                    </div>

                    <div class="mt-8 text-center" data-aos="fade-up"
                        data-aos-delay="{{ count($gallery->images) * 100 + 100 }}">
                        <a href="{{ route('gallery') }}"
                            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                            &larr; Kembali ke Daftar Galeri
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
