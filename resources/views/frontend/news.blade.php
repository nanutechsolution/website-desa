<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
    </div>
</x-app-layout>
