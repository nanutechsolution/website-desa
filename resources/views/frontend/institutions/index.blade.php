<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lembaga Desa Orakeri') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown text-center" data-aos="fade-down">Organisasi &
                        Lembaga di Desa Kami</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($institutions as $index => $institution)
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:scale-105 transform"
                                data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                                <a href="{{ route('institutions.show', $institution->slug) }}" class="block">
                                    @if ($institution->image)
                                        <img src="{{ $institution->image_url }}" alt="Logo {{ $institution->name }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <div
                                            class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                            Tidak Ada Logo</div>
                                    @endif
                                    <div class="p-6">
                                        <span
                                            class="text-sm font-semibold text-desa-green mb-1 block">{{ $institution->category ?? 'Umum' }}</span>
                                        <h4 class="text-xl font-bold mb-2 text-dark-text">{{ $institution->name }}</h4>
                                        <p class="text-gray-700 text-sm mb-4">
                                            {{ Str::limit($institution->description, 100) }}</p>
                                        <p class="text-gray-600 text-sm">Ketua: {{ $institution->leader_name ?? '-' }}
                                        </p>
                                        <span
                                            class="inline-block bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm mt-4 transition-colors duration-300">Lihat
                                            Detail &rarr;</span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada lembaga desa yang
                                dipublikasikan.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $institutions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
