<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visi & Misi Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-desa-brown" data-aos="fade-down">Visi Desa Orakeri:</h3>
                    <p class="mb-6 text-gray-700" data-aos="fade-up" data-aos-delay="100">
                        {!! $visi->content ?? 'Visi desa belum diatur. Silakan hubungi admin.' !!} {{-- Render HTML jika ada --}}
                    </p>

                    <h3 class="text-2xl font-bold mb-4 text-desa-brown mt-8" data-aos="fade-down">Misi Desa Orakeri:
                    </h3>
                    <div class="prose text-gray-700 leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                        {!! $misi->content ?? 'Misi desa belum diatur. Silakan hubungi admin.' !!} {{-- Render HTML jika ada --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
