{{-- resources/views/frontend/news/news_show.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $article->title }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- === Artikel & Komentar (2 Kolom) === --}}
                <div class="lg:col-span-2">

                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6 text-gray-900">
                        <h1 class="text-3xl font-bold mb-4" style="color: var(--color-accent);" data-aos="fade-down">
                            {{ $article->title }}
                        </h1>
                        <p class="text-sm text-gray-600 mb-4" data-aos="fade-down" data-aos-delay="100">
                            Oleh {{ $article->author ?? 'Admin' }} pada
                            {{ $article->published_at ? $article->published_at->format('d F Y H:i') : '-' }}
                        </p>
                        @if ($article->image)
                            <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                class="w-full h-96 object-cover rounded-lg shadow-md mb-6" data-aos="zoom-in">
                        @endif

                        <div class="prose max-w-none text-gray-700 leading-relaxed mt-6"
                            style="color: var(--color-dark-text);" data-aos="fade-up">
                            {!! $article->content !!}
                        </div>

                        <div class="mt-8 text-center" data-aos="fade-up" data-aos-delay="200">
                            <a href="{{ route('news') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150"
                                style="color: var(--color-dark-text); focus-ring-color: var(--color-secondary);">
                                {{-- Ubah warna fokus --}}
                                &larr; Kembali ke Berita
                            </a>
                        </div>
                    </div>

                    {{-- Komentar & Form --}}
                    <div class="mt-12 bg-white shadow-sm rounded-lg p-6 border border-gray-100" data-aos="fade-up">
                        <div class="mt-12 border-t border-gray-200 pt-8" data-aos="fade-up" data-aos-delay="300"
                            style="border-color: var(--color-soft-gray-dark);"> {{-- Warna border --}}
                            <h3 class="text-2xl font-bold mb-6" style="color: var(--color-accent);">Komentar <span
                                    class="text-gray-500 text-lg">({{ $article->comments()->where('is_approved', true)->count() }})</span>
                            </h3>

                            {{-- Pesan Sukses Komentar --}}
                            @if (session('success_comment'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6"
                                    role="alert"
                                    style="background-color: var(--color-primary-light); border-color: var(--color-primary-dark); color: var(--color-primary-darker);">
                                    {{-- Warna pesan sukses --}}
                                    <strong class="font-bold">Berhasil!</strong>
                                    <span class="block sm:inline">{{ session('success_comment') }}</span>
                                </div>
                            @endif

                            {{-- Daftar Komentar yang Disetujui --}}
                            <div class="space-y-6 mb-10">
                                @forelse ($article->comments()->where('is_approved', true)->orderBy('created_at', 'asc')->get() as $comment)
                                    <div class="p-4 rounded-lg shadow-sm"
                                        style="background-color: var(--color-soft-gray);"> {{-- Warna latar belakang komentar --}}
                                        <div class="flex items-center mb-2">
                                            <div class="font-bold" style="color: var(--color-dark-text);">
                                                {{ $comment->guest_name ?? ($comment->user->name ?? 'Anonim') }}</div>
                                            <div class="text-sm text-gray-500 ml-3">
                                                {{ $comment->created_at->diffForHumans() }}</div>
                                        </div>
                                        <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-center">Belum ada komentar yang disetujui. Jadilah yang
                                        pertama berkomentar!</p>
                                @endforelse
                            </div>

                            {{-- Formulir Komentar --}}
                            <h4 class="text-xl font-bold mb-4" style="color: var(--color-primary);">Tinggalkan Komentar
                                Anda</h4> {{-- Warna judul form --}}
                            <form action="{{ route('comments.store', $article->slug) }}" method="POST"
                                class="p-6 rounded-lg shadow-sm" style="background-color: var(--color-soft-gray);">
                                {{-- Latar belakang form --}}
                                @csrf
                                @guest {{-- Tampilkan field nama/email jika belum login --}}
                                    <div class="mb-4">
                                        <label for="guest_name" class="block text-sm font-medium text-gray-700">Nama
                                            Anda</label>
                                        <input type="text" name="guest_name" id="guest_name"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-opacity-50"
                                            value="{{ old('guest_name') }}" required
                                            style="border-color: var(--color-soft-gray-dark); focus-border-color: var(--color-primary); focus-ring-color: var(--color-primary);">
                                        {{-- Warna border dan fokus --}}
                                        @error('guest_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="guest_email" class="block text-sm font-medium text-gray-700">Email
                                            Anda</label>
                                        <input type="email" name="guest_email" id="guest_email"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-opacity-50"
                                            value="{{ old('guest_email') }}" required
                                            style="border-color: var(--color-soft-gray-dark); focus-border-color: var(--color-primary); focus-ring-color: var(--color-primary);">
                                        @error('guest_email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endguest
                                <div class="mb-4">
                                    <label for="content" class="block text-sm font-medium text-gray-700">Komentar
                                        Anda</label>
                                    <textarea name="content" id="content_comment_form" rows="5"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-opacity-50" required
                                        style="border-color: var(--color-soft-gray-dark); focus-border-color: var(--color-primary); focus-ring-color: var(--color-primary);">{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- RECAPTCHA --}}
                                @guest
                                    <div class="mb-4">
                                        {!! NoCaptcha::display() !!}
                                        @error('g-recaptcha-response')
                                            <p class="text-red-500 text-xs mt-1">Verifikasi reCAPTCHA gagal. Harap coba lagi.
                                            </p>
                                        @enderror
                                    </div>
                                @endguest

                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150"
                                    style="background-color: var(--color-primary); focus-bg-color: var(--color-primary-dark); active-bg-color: var(--color-primary-darker);">
                                    {{-- Warna tombol submit --}}
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- === Sidebar (1 Kolom) === --}}
                <aside class="space-y-8" data-aos="fade-left">

                    {{-- Berita Terbaru --}}
                    <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-xl font-bold mb-4 border-b pb-2"
                            style="color: var(--color-accent); border-color: var(--color-soft-gray-dark);">Berita
                            Terbaru</h3>
                        <ul class="space-y-3">
                            @foreach ($latestNews as $latest)
                                <li>
                                    <a href="{{ route('news.show', $latest->slug) }}"
                                        class="block text-sm font-medium transition"
                                        style="color: var(--color-dark-text); hover-color: var(--color-primary);">
                                        {{-- Warna link berita --}}
                                        • {{ Str::limit($latest->title, 60) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Kategori (Jika ada) --}}
                    {{-- Anda bisa mengaktifkan ini jika punya kategori --}}
                    {{-- <div class="bg-white rounded-lg shadow p-4">
                        <h3 class="text-xl font-bold text-desa-brown mb-4 border-b pb-2">Kategori</h3>
                        <ul class="flex flex-wrap gap-2">
                            @foreach ($categories as $category)
                                <a href="{{ route('news.category', $category->slug) }}"
                                    class="bg-gray-100 hover:bg-desa-green-100 text-gray-700 text-xs px-3 py-1 rounded-full transition">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </ul>
                    </div> --}}

                </aside>
            </div>
        </div>
    </div>

</x-app-layout>
