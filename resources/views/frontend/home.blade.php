<x-app-layout>
    {{-- Hero Slider Section --}}
    <div class="relative w-full overflow-hidden h-screen" x-data="{ activeSlide: 0, slides: {{ $sliders->toJson() }} }" x-init="if (slides.length > 1) {
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
                style="background-image: url('{{ Storage::url($slider->image) }}');">
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
            <div class="relative w-full overflow-hidden h-screen flex items-center justify-center">
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
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold tracking-tight mb-6 text-accent" data-aos="fade-down">
                Selamat Datang di {{ $villageName->content ?? 'Nama Desa' }}!
            </h2>

            <p class="text-lg md:text-xl text-gray-700 dark:text-gray-300 leading-relaxed mb-8" data-aos="fade-up"
                data-aos-delay="100">
                {!! $sekilasDesa->content ?? 'Teks sambutan desa belum diatur. Silakan hubungi admin.' !!}
            </p>

            <a href="{{ route('profil.visi') }}"
                class="inline-flex items-center justify-center px-8 py-3 
                   text-white text-sm font-semibold rounded-full shadow-lg 
                   transition duration-300 focus:outline-none 
                   focus:ring-2 focus:ring-offset-2"
                style="background-color: var(--color-primary); 
                   --tw-ring-color: var(--color-primary);"
                onmouseover="this.style.backgroundColor = 'var(--color-primary-darker)'"
                onmouseout="this.style.backgroundColor = 'var(--color-primary)'" data-aos="zoom-in"
                data-aos-delay="200">
                Pelajari Lebih Lanjut Tentang Kami
            </a>
        </div>
    </section>


    <section id="potensi" class="py-20 bg-[--color-soft-gray]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-accent border-accent inline-block pb-2">
                    Potensi {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <div class="w-24 h-1 mx-auto bg-[--color-primary-dark] mt-4"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse ($potentials as $index => $potential)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105 duration-500"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                        @if ($potential->image)
                            <img src="{{ Storage::url($potential->image) }}" alt="{{ $potential->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-[--color-dark-text] mb-3">{{ $potential->title }}
                            </h3>
                            <p class="text-gray-600 mb-4">{!! Str::limit($potential->description, 100) !!}</p>
                            <a href="{{ route('potentials') }}"
                                class="font-medium inline-flex items-center text-[--color-primary-dark] hover:underline">
                                Selengkapnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada potensi desa yang ditambahkan.</p>
                @endforelse
            </div>

            @if ($potentials->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('potentials') }}"
                        class="inline-block text-white bg-[--color-primary] font-bold py-3 px-8 rounded-full transition duration-300 hover:bg-[--color-primary-dark]">
                        Lihat Semua Potensi
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section id="berita-terbaru" class="py-20 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-accent">Berita Terbaru</h2>
                <div class="w-24 h-1 mx-auto bg-[--color-primary-dark]"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($news as $index => $article)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden transition hover:shadow-lg duration-300"
                        data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">

                        @if ($article->image)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-2 text-[--color-primary] hover:opacity-80">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                Oleh {{ $article->author ?? 'Admin' }} pada
                                {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-4">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <a href="{{ route('news.show', $article->slug) }}"
                                class="inline-block bg-[--color-primary] text-white font-bold py-2 px-4 rounded-md text-sm hover:bg-[--color-primary-dark] transition">
                                Baca Selengkapnya →
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-300">
                        Belum ada berita terbaru yang dipublikasikan.
                    </p>
                @endforelse
            </div>

            @if ($news->count() > 0)
                <div class="text-center mt-12">
                    <a href="{{ route('news') }}"
                        class="inline-block text-white text-sm bg-[--color-primary] font-bold py-3 px-8 rounded-full transition duration-300 hover:bg-[--color-primary-dark]">
                        Lihat Semua Berita
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="py-20 bg-gradient-to-r from-primary-light/10 via-white to-primary-light/10 backdrop-blur-md">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-extrabold text-center text-accent mb-14 tracking-tight" data-aos="fade-down">
                🚀 Akses Cepat Layanan Warga
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Kartu 1 --}}
                <a href="#"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-primary hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="100">
                    <div class="absolute top-0 right-0 m-3">
                        <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-primary rounded-full">
                            NEW
                        </span>
                    </div>
                    <svg class="h-14 w-14 text-primary mx-auto mb-4 group-hover:scale-110 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2.001.001C18.064 16.038 19 14.542 19 13c0-2.485-2.5-5-5.5-5S8 10.515 8 13c0 1.542.936 3.038 2.001 4.001zM12 21a9 9 0 100-18 9 9 0 000 18z" />
                    </svg>
                    <h3 class="text-lg font-bold text-primary">Ajukan Surat Online</h3>
                    <p class="text-secondary-dark text-sm mt-2">Permohonan dokumen desa secara daring, tanpa ribet.</p>
                </a>

                {{-- Kartu 2 --}}
                <a href="{{ route('service-procedures') }}"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-secondary hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="200">
                    <svg class="h-14 w-14 text-secondary mx-auto mb-4 group-hover:rotate-6 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="text-lg font-bold text-secondary">Prosedur Layanan</h3>
                    <p class="text-secondary-dark text-sm mt-2">Panduan lengkap urusan administratif.</p>
                </a>

                {{-- Kartu 3 --}}
                <a href="{{ route('documents') }}"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-accent hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="300">
                    <svg class="h-14 w-14 text-accent mx-auto mb-4 group-hover:rotate-3 transition" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m7 0V5m0 0a2 2 0 012-2h2a2 2 0 012 2v2m-6 6v4m-6-4v4" />
                    </svg>
                    <h3 class="text-lg font-bold text-accent">Unduh Dokumen</h3>
                    <p class="text-secondary-dark text-sm mt-2">Akses arsip dan peraturan desa dengan mudah.</p>
                </a>

                {{-- Kartu 4 --}}
                <a href="#"
                    class="group relative bg-white rounded-2xl shadow-xl hover:shadow-2xl p-6 text-center transition-all duration-300 border-t-4 border-primary-light hover:-translate-y-1"
                    data-aos="zoom-in" data-aos-delay="400">
                    <svg class="h-14 w-14 text-primary-light mx-auto mb-4 group-hover:scale-110 transition"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="text-lg font-bold text-accent-light">Lokasi & Kontak</h3>
                    <p class="text-secondary-dark text-sm mt-2">Cari kami, kirim pesan, atau langsung datang!</p>
                </a>
            </div>
        </div>
    </section>

    <section id="galeri" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-extrabold text-accent dark:text-white mb-2">
                    Galeri {{ $villageName->content ?? 'Nama Desa' }}
                </h2>
                <p class="text-gray-500 dark:text-gray-300 text-sm">Dokumentasi kegiatan dan potret desa kami</p>
                <div class="mt-4 w-16 h-1 mx-auto bg-accent"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @php
                    $homepageGalleries = App\Models\Gallery::where('is_published', true)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->with('images')
                        ->get();
                @endphp

                @forelse ($homepageGalleries as $index => $gallery)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden"
                        data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
                        <a href="{{ route('gallery.show', $gallery->slug) }}" class="block group">
                            @if ($gallery->cover_image)
                                <img src="{{ Storage::url($gallery->cover_image) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                            @elseif ($gallery->images->isNotEmpty())
                                <img src="{{ Storage::url($gallery->images->first()->path) }}"
                                    alt="Sampul {{ $gallery->name }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-64 flex items-center justify-center bg-gray-200 dark:bg-gray-700 text-gray-500">
                                    No Image
                                </div>
                            @endif

                            <div class="p-5">
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-white mb-1">
                                    {{ Str::limit($gallery->name, 40) }}
                                </h4>
                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                    {{ $gallery->images->count() }} Foto
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500 dark:text-gray-400">
                        Belum ada album galeri yang dipublikasikan.
                    </p>
                @endforelse
            </div>

            @if ($homepageGalleries->count() > 0)
                <div class="text-center mt-14">
                    <a href="{{ route('gallery') }}"
                        class="inline-block bg-primary text-white font-semibold py-3 px-10 rounded-full shadow-md hover:bg-primary-dark active:bg-primary-darker transition">
                        Lihat Semua Galeri
                    </a>

                </div>
            @endif
        </div>
    </section>

    <section id="lokasi" class="py-20 bg-soft-gray">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-down">
                <h2 class="text-3xl md:text-4xl font-bold text-accent mb-4">Lokasi Kantor Desa</h2>
                <div class="w-24 h-1 bg-accent mx-auto"></div>
            </div>
            <div class="flex flex-col lg:flex-row gap-10">
                <div class="lg:w-full" data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-white p-8 rounded-lg shadow-md h-full">
                        <h3 class="text-xl font-semibold text-dark-text mb-4">Informasi Kontak & Lokasi</h3>
                        <div class="aspect-w-16 aspect-h-9 mb-6">
                            {{-- Menggunakan string URL Google Maps dinamis --}}
                            @if ($googleMapsEmbedUrl)
                                {{-- Cukup cek apakah string URLnya tidak null --}}
                                <iframe src="{{ $googleMapsEmbedUrl }}" width="100%" height="100%"
                                    {{-- Langsung pakai variabel --}} style="min-height: 300px;" allowfullscreen=""
                                    loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-lg">
                                </iframe>
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500 rounded-lg"
                                    style="min-height: 300px;">
                                    Peta belum diatur atau koordinat tidak valid.
                                </div>
                            @endif
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
                                <p class="text-gray-700">
                                    @if ($contactAddress && $contactAddress->content)
                                        {!! $contactAddress->content !!}
                                    @else
                                        Alamat belum diatur.
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <p class="text-gray-700">
                                    @if ($contactEmail && $contactEmail->content)
                                        <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                            class="text-desa-skyblue hover:underline">{{ strip_tags($contactEmail->content) }}</a>
                                    @else
                                        Email belum diatur.
                                    @endif
                                </p>
                            </div>
                            <div class="flex items-start space-x-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-desa-green-600 mt-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <p class="text-gray-700">
                                    @if ($contactPhone && $contactPhone->content)
                                        @php $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content); @endphp
                                        <a href="tel:{{ $cleanPhoneNumber }}"
                                            class="text-desa-skyblue hover:underline">{{ strip_tags($contactPhone->content) }}</a>
                                    @else
                                        Telepon belum diatur.
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
