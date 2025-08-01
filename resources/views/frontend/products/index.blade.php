<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $villageName->content }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                {{-- Filter Sidebar (Kolom Kiri) --}}
                <div class="lg:col-span-1">
                    @include('frontend.products.partials._filter_sidebar', [
                        'categories' => $categories,
                        'category' => $category,
                    ])
                </div>

                {{-- Daftar Produk (Kolom Kanan) --}}
                <div class="lg:col-span-3">
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                        <h3 class="text-2xl font-bold mb-6 text-center" style="color: var(--color-accent);"
                            data-aos="fade-down">
                            @if ($category && $category !== 'all')
                                Produk Kategori {{ $category }}
                            @else
                                Karya Terbaik Masyarakat Kami
                            @endif
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @forelse ($products as $index => $product)
                                <div class="bg-white rounded-lg shadow-xl overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:scale-105 transform"
                                    data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                                    <a href="{{ route('products.show', $product->slug) }}" class="block">
                                        @if ($product->image)
                                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                                class="w-full h-56 object-cover">
                                        @else
                                            <div
                                                class="w-full h-56 bg-gray-200 flex items-center justify-center text-gray-500">
                                                No Image</div>
                                        @endif
                                        <div class="p-6">
                                            <span class="text-sm font-semibold mb-1 block"
                                                style="color: var(--color-primary);">{{ $product->category ?? 'Umum' }}</span>
                                            <h4 class="text-xl font-bold mb-2" style="color: var(--color-dark-text);">
                                                {{ $product->name }}</h4>
                                            <p class="text-gray-700 text-sm mb-4">
                                                {{ Str::limit($product->short_description, 100) }}</p>
                                            <p class="text-2xl font-bold mb-4" style="color: var(--color-secondary);">Rp
                                                {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                            <span
                                                class="inline-block text-white font-bold py-2 px-4 rounded-full text-sm transition-colors duration-300"
                                                style="background-color: var(--color-primary);">Lihat Detail
                                                &rarr;</span>
                                        </div>
                                    </a>
                                </div>
                            @empty
                                <p class="col-span-full text-center text-gray-500">Belum ada produk yang dipublikasikan.
                                </p>
                            @endforelse
                        </div>

                        <div class="mt-8">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
