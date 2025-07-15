<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $procedure->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold mb-4 text-desa-brown" data-aos="fade-down">{{ $procedure->title }}</h1>
                    @if ($procedure->category)
                        <span
                            class="inline-block bg-desa-skyblue bg-opacity-20 text-desa-skyblue text-sm font-semibold px-3 py-1 rounded-full mb-4"
                            data-aos="fade-down" data-aos-delay="100">{{ $procedure->category }}</span>
                    @endif
                    <p class="text-gray-700 text-base mb-6" data-aos="fade-up" data-aos-delay="200">
                        {{ $procedure->description }}</p>

                    <h2 class="text-2xl font-bold mb-4 text-desa-green mt-8" data-aos="fade-up" data-aos-delay="300">
                        Langkah-langkah & Persyaratan:</h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed mt-6" data-aos="fade-up"
                        data-aos-delay="400">
                        {!! $procedure->steps_requirements !!} {{-- Render HTML jika ada --}}
                    </div>

                    <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="500">
                        <a href="{{ route('service-procedures') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-desa-skyblue focus:ring-offset-2 transition ease-in-out duration-150">
                            &larr; Kembali ke Daftar Prosedur
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
