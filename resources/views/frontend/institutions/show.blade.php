<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $institution->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div data-aos="zoom-in">
                            @if ($institution->image)
                                <img src="{{ $institution->image_url }}" alt="{{ $institution->name }}"
                                    class="w-full h-80 object-cover rounded-lg shadow-md">
                            @else
                                <div
                                    class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                    Tidak Ada Logo</div>
                            @endif
                        </div>
                        <div data-aos="fade-left" data-aos-delay="100">
                            <span
                                class="text-sm font-semibold text-desa-green mb-2 block">{{ $institution->category ?? 'Umum' }}</span>
                            <h1 class="text-3xl font-bold mb-2 text-desa-brown">{{ $institution->name }}</h1>
                            <p class="text-lg text-gray-700 mb-4">Ketua:
                                {{ $institution->leader_name ?? 'Belum ditentukan' }}</p>

                            <h3 class="text-xl font-bold text-dark-text mb-2">Profil Lembaga:</h3>
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $institution->description ?? 'Tidak ada deskripsi lengkap untuk lembaga ini.' !!}
                            </div>

                            <h3 class="text-xl font-bold text-dark-text mb-2 mt-6">Kontak Lembaga:</h3>
                            <div class="space-y-2 text-gray-700">
                                @if ($institution->contact_phone)
                                    <p><strong>Telepon:</strong> <a
                                            href="tel:{{ preg_replace('/[^0-9+]/', '', $institution->contact_phone) }}"
                                            class="text-desa-skyblue hover:underline">{{ $institution->contact_phone }}</a>
                                    </p>
                                @endif
                                @if ($institution->contact_email)
                                    <p><strong>Email:</strong> <a href="mailto:{{ $institution->contact_email }}"
                                            class="text-desa-skyblue hover:underline">{{ $institution->contact_email }}</a>
                                    </p>
                                @endif
                                @if (!$institution->contact_phone && !$institution->contact_email)
                                    <p class="text-gray-500">Informasi kontak belum tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('institutions.index') }}"
                            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                            &larr; Kembali ke Daftar Lembaga
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
