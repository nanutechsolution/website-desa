<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div data-aos="zoom-in">
                            @if ($product->image)
                                <div data-aos="zoom-in">
                                    {{-- Menggunakan accessor image_url --}}
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                        class="w-full h-80 object-cover rounded-lg shadow-md">
                                </div>
                            @else
                                <div
                                    class="w-full h-80 bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg">
                                    Tidak Ada Gambar</div>
                            @endif
                        </div>
                        <div data-aos="fade-left" data-aos-delay="100">
                            <h1 class="text-3xl font-bold mb-2 text-desa-brown">{{ $product->name }}</h1>
                            <span
                                class="text-sm font-semibold text-desa-green mb-4 block">{{ $product->category ?? 'Umum' }}</span>
                            <p class="text-2xl font-bold text-desa-skyblue mb-4">Rp
                                {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                            <p class="text-gray-700 text-lg mb-6">{{ $product->short_description }}</p>

                            <h3 class="text-xl font-bold text-dark-text mb-2">Deskripsi Lengkap:</h3>
                            <div class="prose max-w-none text-gray-700 leading-relaxed">
                                {!! $product->description ?? 'Tidak ada deskripsi lengkap.' !!}
                            </div>

                            <h3 class="text-xl font-bold text-dark-text mb-2 mt-6">Informasi Pemesanan:</h3>
                            <div class="space-y-2 text-gray-700">
                                @if ($product->contact_person)
                                    <p><strong>Kontak:</strong> {{ $product->contact_person }}</p>
                                @endif
                                @if ($product->contact_phone)
                                    <p><strong>Telepon:</strong> <a href="tel:{{ $product->contact_phone }}"
                                            class="text-desa-skyblue hover:underline">{{ $product->contact_phone }}</a>
                                    </p>
                                @endif
                                @if ($product->contact_email)
                                    <p><strong>Email:</strong> <a href="mailto:{{ $product->contact_email }}"
                                            class="text-desa-skyblue hover:underline">{{ $product->contact_email }}</a>
                                    </p>
                                @endif
                                @if (!$product->contact_person && !$product->contact_phone && !$product->contact_email)
                                    <p class="text-gray-500">Informasi kontak belum tersedia.</p>
                                @endif
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $product->contact_phone) }}?text=Halo%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}%20di%20website%20Desa%20Orakeri."
                                    target="_blank"
                                    class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-md mt-4">
                                    <i class="fab fa-whatsapp mr-2"></i> Pesan via WhatsApp
                                </a>
                                {{-- Pastikan Font Awesome dimuat untuk ikon WhatsApp --}}
                                {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"> --}}
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('products') }}"
                            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                            &larr; Kembali ke Daftar Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
