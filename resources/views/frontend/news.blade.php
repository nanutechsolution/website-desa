<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-dark-text leading-tight">
            {{ __('Berita Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- === Kolom Kiri: Daftar Berita === --}}
            <div class="lg:col-span-2 space-y-8">

                @forelse ($news as $article)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 hover:shadow-md transition"
                        data-aos="fade-up" data-aos-delay="100">
                        <div class="flex flex-col md:flex-row gap-6">
                            @if ($article->image)
                                <img src="{{ Storage::url($article->image) }}" alt="{{ $article->title }}"
                                    class="w-full md:w-1/3 h-48 object-cover rounded-lg">
                            @endif
                            <div class="md:flex-1">
                                <h4 class="text-xl font-bold text-dark-text hover:text-primary transition">
                                    <a href="{{ route('news.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h4>
                                <p class="text-sm text-gray-500 mt-1">
                                    Oleh {{ $article->author ?? 'Admin' }} •
                                    {{ $article->published_at ? $article->published_at->format('d F Y') : '-' }}
                                </p>
                                <p class="mt-2 text-gray-700 leading-relaxed">
                                    {{ Str::limit(strip_tags($article->content), 150) }}
                                </p>
                                <a href="{{ route('news.show', $article->slug) }}"
                                    class="mt-3 inline-block text-primary hover:underline font-medium">
                                    Baca Selengkapnya →
                                </a>
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
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h4 class="text-lg font-bold text-accent border-b pb-2 mb-4">Berita Terbaru</h4>
                    <ul class="space-y-2">
                        @forelse ($latestNews ?? [] as $latest)
                            <li>
                                <a href="{{ route('news.show', $latest->slug) }}"
                                    class="block text-sm text-dark-text hover:text-primary transition font-medium">
                                    • {{ Str::limit($latest->title, 60) }}
                                </a>
                            </li>
                        @empty
                            <li class="text-sm text-gray-400">Belum ada berita.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- (Opsional) Kategori --}}
                {{-- 
                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h4 class="text-lg font-bold text-accent border-b pb-2 mb-4">Kategori</h4>
                    <ul class="flex flex-wrap gap-2">
                        @foreach ($categories ?? [] as $cat)
                            <a href="{{ route('news.category', $cat->slug) }}"
                                class="bg-soft-gray text-dark-text text-xs px-3 py-1 rounded-full hover:bg-primary hover:text-white transition">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </ul>
                </div>
                --}}
            </aside>
        </div>
    </div>
</x-app-layout>
