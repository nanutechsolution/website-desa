{{-- resources/views/frontend/products/index.blade.php --}}
<x-app-layout>
    {{-- ... header section ... --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown text-center" data-aos="fade-down">Karya Terbaik
                        Masyarakat Kami</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse ($products as $index => $product)
                            <div class="bg-white rounded-lg shadow-xl overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:scale-105 transform"
                                data-aos="fade-up" data-aos-delay="{{ 100 * ($index + 1) }}">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    {{-- Menggunakan accessor image_url --}}
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                                        class="w-full h-56 object-cover">
                                    <div class="p-6">
                                        <span
                                            class="text-sm font-semibold text-desa-green mb-1 block">{{ $product->category ?? 'Umum' }}</span>
                                        <h4 class="text-xl font-bold mb-2 text-dark-text">{{ $product->name }}</h4>
                                        <p class="text-gray-700 text-sm mb-4">
                                            {{ Str::limit($product->short_description, 100) }}</p>
                                        <p class="text-2xl font-bold text-desa-skyblue mb-4">Rp
                                            {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                                        <span
                                            class="inline-block bg-desa-green hover:bg-desa-green-700 text-white font-bold py-2 px-4 rounded-full text-sm transition-colors duration-300">Lihat
                                            Detail &rarr;</span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="col-span-full text-center text-gray-500">Belum ada produk yang dipublikasikan.</p>
                        @endforelse
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
