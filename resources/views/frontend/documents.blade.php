<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dokumen Publik Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown text-center" data-aos="fade-down">Arsip Dokumen
                        Resmi Desa</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($documents as $index => $document)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden p-6" data-aos="fade-up"
                                data-aos-delay="{{ 100 * ($index + 1) }}">
                                <h4 class="text-xl font-bold mb-2 text-desa-green">{{ $document->title }}</h4>
                                <p class="text-gray-700 text-sm mb-4">{{ Str::limit($document->description, 100) }}</p>
                                <div class="flex items-center text-gray-600 text-sm mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-desa-skyblue"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Tipe: {{ strtoupper($document->file_type ?? 'FILE') }}</span>
                                </div>
                                <a href="{{ route('documents.download', $document->slug) }}"
                                    class="inline-block bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-sm transition-colors duration-300">
                                    Unduh Dokumen &rarr;
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Tidak ada dokumen yang dipublikasikan.
                            </p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
