<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sejarah Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4 text-desa-brown" data-aos="fade-down">Sejarah Singkat Desa Orakeri
                    </h3>
                    <div class="prose text-gray-700 leading-relaxed mt-6" data-aos="fade-up" data-aos-delay="100">
                        {!! $sejarah->content ?? 'Sejarah desa belum diatur. Silakan hubungi admin.' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
