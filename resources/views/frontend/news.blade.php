<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita Desa Orakeri') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- === Kolom Kiri: Daftar Berita === --}}
            <div class="lg:col-span-2">

                @forelse ($news as $article)
                    <div class="mb-8 p-6 border-b border-gray-200 last:border-b-0 bg-white rounded-lg shadow-sm"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="flex flex-col md:flex-row items-start md:space-x-6">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                                    class="w-full md:w-1/3 h-48 object-cover rounded-lg shadow-md mb-4 md:mb-0">
                            @endif
                            <div class="md:w-2/3">
                                <h4 class="text-xl font-bold mb-2 text-dark-text hover:text-desa-skyblue">
                                    <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                </h4>
                                <p class="text-sm text-gray-600 mb-2">
                                    Oleh {{ $article->author ?? 'Admin' }} pada
                                    {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                                </p>
                                <p class="text-gray-700 leading-relaxed">
                                    {{ Str::limit(strip_tags($article->content), 150) }}
                                </p>
                                <a href="{{ route('news.show', $article->slug) }}"
                                    class="mt-3 inline-block text-desa-skyblue hover:underline">Baca Selengkapnya
                                    &rarr;</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                @endforelse

                <div class="mt-8">
                    {{ $news->links() }}
                </div>
            </div>

            {{-- === Kolom Kanan: Sidebar === --}}
            <aside class="space-y-8" data-aos="fade-left">
                {{-- Berita Terbaru --}}
                <div class="bg-white p-4 shadow rounded-lg">
                    <h4 class="text-lg font-bold text-desa-brown mb-4 border-b pb-2">Berita Terbaru</h4>
                    <ul class="space-y-2">
                        @foreach ($latestNews ?? [] as $latest)
                            <li>
                                <a href="{{ route('news.show', $latest->slug) }}"
                                    class="block text-sm text-gray-700 hover:text-desa-green font-medium transition">
                                    • {{ Str::limit($latest->title, 60) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- (Opsional) Kategori --}}
                {{-- 
            <div class="bg-white p-4 shadow rounded-lg">
                <h4 class="text-lg font-bold text-desa-brown mb-4 border-b pb-2">Kategori</h4>
                <ul class="flex flex-wrap gap-2">
                    @foreach ($categories ?? [] as $cat)
                        <a href="{{ route('news.category', $cat->slug) }}"
                            class="bg-gray-100 hover:bg-desa-green-100 text-gray-700 text-xs px-3 py-1 rounded-full transition">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </ul>
            </div>
            --}}
            </aside>
        </div>
    </div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown text-center" data-aos="fade-down">Berita Terkini
                        Desa Kami</h3>

                    @forelse ($news as $article)
                        <div class="mb-8 p-6 border-b border-gray-200 last:border-b-0" data-aos="fade-up"
                            data-aos-delay="100">
                            <div class="flex flex-col md:flex-row items-start md:space-x-6">
                                @if ($article->image)
                                    <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                                        class="w-full md:w-1/3 h-48 object-cover rounded-lg shadow-md mb-4 md:mb-0">
                                @endif
                                <div class="md:w-2/3">
                                    <h4 class="text-xl font-bold mb-2 text-dark-text hover:text-desa-skyblue">
                                        <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        Oleh {{ $article->author ?? 'Admin' }} pada
                                        {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                                    </p>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit(strip_tags($article->content), 200) }}
                                    </p>
                                    <a href="{{ route('news.show', $article->slug) }}"
                                        class="mt-3 inline-block text-desa-skyblue hover:underline">Baca Selengkapnya
                                        &rarr;</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Belum ada berita yang dipublikasikan.</p>
                    @endforelse

                    <div class="mt-8">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>
