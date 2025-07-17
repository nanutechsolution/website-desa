<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Potensi Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown text-center" data-aos="fade-down">Jelajahi Potensi
                        Unggulan Desa Kami</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($potentials as $potential)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:scale-105 duration-500"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                @if ($potential->image)
                                    <img src="{{ Storage::url($potential->image) }}" alt="{{ $potential->title }}"
                                        class="w-full h-48 object-cover">
                                @endif
                                <div class="p-6">
                                    <h4 class="text-xl font-bold mb-2 text-desa-green">{{ $potential->title }}</h4>
                                    <p class="text-gray-700">{{ strip_tags(Str::limit($potential->description, 150)) }}
                                    </p>
                                    {{-- Tambahkan link "Baca Selengkapnya" jika ada halaman detail --}}
                                    {{-- Jika Anda mengimplementasikan PotentialController@show: --}}
                                    {{-- <a href="{{ route('potentials.show', $potential->slug) }}" class="mt-3 inline-block text-desa-skyblue hover:underline">Baca Selengkapnya &rarr;</a> --}}
                                </div>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada potensi desa yang ditambahkan.
                            </p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $potentials->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
