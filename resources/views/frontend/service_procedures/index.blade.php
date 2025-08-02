<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prosedur Layanan Desa Orakeri') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-accent text-center" data-aos="fade-down">Panduan Layanan
                        untuk Warga</h3>
                    <div class="space-y-6">
                        @forelse ($procedures as $index => $procedure)
                            <div class="p-5 border rounded-lg shadow-md transition hover:shadow-lg" data-aos="fade-up"
                                data-aos-delay="{{ 100 * ($index + 1) }}">
                                <h4 class="text-xl font-bold mb-2 text-desa-green">{{ $procedure->title }}</h4>
                                <p class="text-gray-700 text-sm mb-3">
                                    {{ $procedure->description ?? 'Tidak ada deskripsi singkat.' }}</p>
                                @if ($procedure->category)
                                    <span
                                        class="inline-block bg-desa-skyblue bg-opacity-20 text-desa-skyblue text-xs font-semibold px-2.5 py-0.5 rounded-full mb-3">{{ $procedure->category }}</span>
                                @endif
                                <a href="{{ route('service-procedures.show', $procedure->slug) }}"
                                    class="block text-desa-skyblue hover:underline mt-2">Baca Prosedur Lengkap
                                    &rarr;</a>
                            </div>
                        @empty
                            <p class="text-center text-gray-500">Belum ada prosedur layanan yang dipublikasikan.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $procedures->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
