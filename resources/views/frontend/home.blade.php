<x-app-layout>
    {{-- Hero Slider Section --}}
    <div class="relative w-full overflow-hidden h-[500px]" x-data="{ activeSlide: 0, slides: {{ $sliders->toJson() }} }" x-init="if (slides.length > 1) {
        setInterval(() => {
            activeSlide = (activeSlide + 1) % slides.length;
        }, 5000);
    }">

        {{-- Slides --}}
        @forelse ($sliders as $index => $slider)
            <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0 w-full h-full bg-cover bg-center bg-no-repeat flex items-center justify-center"
                style="background-image: url('{{ $slider->image }}');">

                {{-- Overlay gradien agar teks lebih kontras --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                <div class="relative z-10 text-center px-4 max-w-2xl mx-auto">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white drop-shadow-lg mb-4 animate-fade-in-down">
                        {{ $slider->title }}
                    </h1>
                    <p class="text-lg text-white/90 leading-relaxed animate-fade-in-up">
                        {{ $slider->description }}
                    </p>
                </div>
            </div>
        @empty
            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                <p class="text-gray-600 text-xl">Tidak ada slider aktif yang tersedia.</p>
            </div>
        @endforelse

        {{-- Dots --}}
        @if ($sliders->count() > 1)
            <div class="absolute bottom-6 left-0 right-0 flex justify-center space-x-3 z-10">
                @foreach ($sliders as $index => $slider)
                    <button @click="activeSlide = {{ $index }}"
                        :class="activeSlide === {{ $index }} ?
                            'w-4 h-4 bg-white shadow-lg scale-110' :
                            'w-3 h-3 bg-gray-400 hover:bg-white/80'"
                        class="rounded-full transition-all duration-300 focus:outline-none"></button>
                @endforeach
            </div>
        @endif

        {{-- Tombol Navigasi --}}
        @if ($sliders->count() > 1)
            <button @click="activeSlide = (activeSlide - 1 + slides.length) % slides.length"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-10 hidden md:block">
                ❮
            </button>
            <button @click="activeSlide = (activeSlide + 1) % slides.length"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/40 hover:bg-black/60 text-white p-3 rounded-full z-10 hidden md:block">
                ❯
            </button>
        @endif
    </div>


    <section class="py-20 bg-white">
        {{-- Ornamen dekoratif background (bisa diganti SVG khas desa) --}}
        <div
            class="absolute inset-0 opacity-5 bg-[url('/images/motif-desa.png')] bg-cover bg-center pointer-events-none">
        </div>

        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-extrabold text-desa-brown mb-6 tracking-tight drop-shadow-sm"
                data-aos="fade-down">
                👋 Selamat Datang di Desa Orakeri!
            </h2>
            <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-8" data-aos="fade-up" data-aos-delay="100">
                {!! $sekilasDesa->content ??
                    '<span class="italic text-red-600">Teks sambutan desa belum diatur. Silakan hubungi admin.</span>' !!}
            </p>
            <a href="{{ route('profil.visi') }}"
                class="inline-flex items-center gap-2 mt-4 bg-desa-green-600 hover:bg-desa-green-700 text-white font-semibold py-3 px-8 rounded-full transition duration-300 shadow-md hover:shadow-lg"
                data-aos="zoom-in" data-aos-delay="200">
                <svg class="h-5 w-5 text-white animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
                Pelajari Lebih Lanjut Tentang Kami
            </a>
        </div>
    </section>
    <section id="berita-terbaru" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold text-desa-brown mb-4">Berita Terbaru</h2>
                <div class="w-24 h-1 bg-desa-green-600 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($news as $index => $article)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition hover:shadow-lg duration-300"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                        @if ($article->image)
                            <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                                class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-dark-text hover:text-desa-skyblue">
                                <a
                                    href="{{ route('news.show', $article->slug) }}">{{ Str::limit($article->title, 50) }}</a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-3">
                                Oleh {{ $article->author ?? 'Admin' }} pada
                                {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                            </p>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('news.show', $article->slug) }}"
                                class="inline-block bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md text-sm">Baca
                                Selengkapnya &rarr;</a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada berita terbaru yang dipublikasikan.
                    </p>
                @endforelse
            </div>
            @if ($news->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('news') }}"
                        class="inline-block bg-desa-green-600 hover:bg-desa-green-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300">Lihat
                        Semua Berita</a>
                </div>
            @endif
        </div>
    </section>
    <section class="py-20 bg-gradient-to-r from-desa-skyblue/10 via-white to-desa-skyblue/10 backdrop-blur-md">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-desa-brown mb-14 tracking-tight" data-aos="fade-down">
                🚀 Akses Cepat Layanan Warga
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Kartu 1 --}}
                <a href="{{ route('online-services') }}"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-desa-skyblue hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="absolute top-0 right-0 m-3">
                        <span
                            class="inline-block px-2 py-1 text-xs font-semibold text-white bg-desa-skyblue rounded-full">
                            NEW
                        </span>
                    </div>
                    <svg class="h-14 w-14 text-desa-skyblue mx-auto mb-4 group-hover:scale-110 transition"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2.001.001C18.064 16.038 19 14.542 19 13c0-2.485-2.5-5-5.5-5S8 10.515 8 13c0 1.542.936 3.038 2.001 4.001zM12 21a9 9 0 100-18 9 9 0 000 18z" />
                    </svg>
                    <h3 class="text-lg font-bold text-desa-brown">Ajukan Surat Online</h3>
                    <p class="text-gray-600 text-sm mt-2">Permohonan dokumen desa secara daring, tanpa ribet.</p>
                </a>

                {{-- Kartu 2 --}}
                <a href="{{ route('service-procedures') }}"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-desa-green hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="200">
                    <svg class="h-14 w-14 text-desa-green mx-auto mb-4 group-hover:rotate-6 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="text-lg font-bold text-desa-green-dark">Prosedur Layanan</h3>
                    <p class="text-gray-600 text-sm mt-2">Panduan lengkap urusan administratif.</p>
                </a>

                {{-- Kartu 3 --}}
                <a href="{{ route('documents') }}"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-desa-brown hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="300">
                    <svg class="h-14 w-14 text-desa-brown mx-auto mb-4 group-hover:rotate-3 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m7 0V5m0 0a2 2 0 012-2h2a2 2 0 012 2v2m-6 6v4m-6-4v4" />
                    </svg>
                    <h3 class="text-lg font-bold text-desa-brown">Unduh Dokumen</h3>
                    <p class="text-gray-600 text-sm mt-2">Akses arsip dan peraturan desa dengan mudah.</p>
                </a>

                {{-- Kartu 4 --}}
                <a href="#"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-desa-skyblue hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="400">
                    <svg class="h-14 w-14 text-desa-skyblue mx-auto mb-4 group-hover:scale-110 transition"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="text-lg font-bold text-desa-skyblue-dark">Lokasi & Kontak</h3>
                    <p class="text-gray-600 text-sm mt-2">Cari kami, kirim pesan, atau langsung datang!</p>
                </a>
            </div>
        </div>
    </section>
    <section id="galeri" class="py-20 bg-soft-gray">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold text-desa-brown mb-4">Galeri Desa Orakeri</h2>
                <div class="w-24 h-1 bg-desa-green-600 mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- Ambil 6 album galeri terbaru untuk ditampilkan di homepage, atau paling baru --}}
                @php
                    $homepageGalleries = App\Models\Gallery::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->with('images')
                        ->get();
                @endphp
                @forelse ($homepageGalleries as $index => $gallery)
                    <div class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in"
                        data-aos-delay="{{ 100 * ($index + 1) }}">
                        <a href="{{ route('gallery.show', $gallery->slug) }}" class="block group">
                            @if ($gallery->cover_image)
                                <img src="{{ Storage::url($gallery->cover_image) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover transform hover:scale-105 transition duration-500">
                            @elseif ($gallery->images->first())
                                <img src="{{ Storage::url($gallery->images->first()->path) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover transform hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-64 flex items-center justify-center bg-gray-200 text-gray-500">No
                                    Image</div>
                            @endif
                            <div class="p-4 bg-white">
                                <h4 class="text-lg font-semibold text-dark-text">{{ Str::limit($gallery->name, 40) }}
                                </h4>
                                <p class="text-sm text-gray-600">{{ $gallery->images->count() }} Foto</p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada album galeri yang dipublikasikan.</p>
                @endforelse
            </div>
            @if ($homepageGalleries->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('gallery') }}"
                        class="inline-block bg-desa-green-600 hover:bg-desa-green-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300">Lihat
                        Semua Galeri</a>
                </div>
            @endif
        </div>
    </section>
    <section id="kontak" class="py-20 bg-soft-gray">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold text-desa-brown mb-4">Hubungi Kami</h2>
                <div class="w-24 h-1 bg-desa-green-600 mx-auto"></div>
            </div>

            <div class="flex flex-col lg:flex-row gap-10">
                <div class="lg:w-1/2" data-aos="fade-right" data-aos-delay="100">
                    <form class="bg-white p-8 rounded-lg shadow-md">
                        <div class="mb-6">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                            <input type="text" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-desa-green-500">
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-desa-green-500">
                        </div>
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Pesan Anda</label>
                            <textarea id="message" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-desa-green-500"></textarea>
                        </div>
                        <button type="submit"
                            class="w-full bg-desa-green-600 text-white py-3 px-6 rounded-md hover:bg-desa-green-700 transition font-medium">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
                <div class="lg:w-1/2" data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-dark-text mb-4">Lokasi Kantor Desa</h3>
                        <div class="aspect-w-16 aspect-h-9 mb-6">
                            {{-- Ganti src Google Maps dengan URL yang valid --}}
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15814.770281699042!2d110.37042557766324!3d-7.794711295982823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a57833a6b3d81%3A0x4027a76e3557e40!2sYogyakarta%20City%2C%20Special%20Region%20of%20Yogyakarta!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                width="100%" height="100%" style="min-height: 300px;" allowfullscreen=""
                                loading="lazy" class="rounded-lg"></iframe>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <p class="text-gray-600">Jl. Raya Orakeri No. 123, Kecamatan Sejahtera, Kabupaten
                                    Harmoni, Jawa Barat 43211</p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-600">desa.orakeri@gmail.com</p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-gray-600">(022) 1234567</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
