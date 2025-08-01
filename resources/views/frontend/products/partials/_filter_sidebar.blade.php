{{-- resources/views/frontend/products/partials/_filter_sidebar.blade.php --}}

<aside class="w-full lg:w-full bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-xl font-bold mb-4"
        style="color: var(--color-dark-text); border-bottom-color: var(--color-soft-gray-dark);">Filter Produk</h3>

    {{-- Filter Kategori --}}
    <div class="mb-6">
        <h4 class="font-semibold text-lg mb-2" style="color: var(--color-accent);">Kategori</h4>
        <ul>
            <li>
                <a href="{{ route('products', ['min_price' => request('min_price'), 'max_price' => request('max_price'), 'category' => 'all']) }}"
                    class="block py-1 text-gray-700 hover:opacity-80 transition-colors duration-200 
                   {{ !request('category') || request('category') == 'all' ? 'font-bold' : '' }}">
                    Semua Kategori
                </a>
            </li>
            @foreach ($categories as $cat)
                @if ($cat !== 'Semua Kategori')
                    <li>
                        <a href="{{ route('products', ['min_price' => request('min_price'), 'max_price' => request('max_price'), 'category' => $cat]) }}"
                            class="block py-1 text-gray-700 hover:opacity-80 transition-colors duration-200 
                       {{ request('category') == $cat ? 'font-bold' : '' }}">
                            {{ $cat }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    {{-- Filter Harga --}}
    <div class="mb-6">
        <h4 class="font-semibold text-lg mb-2" style="color: var(--color-accent);">Harga</h4>
        <ul>
            @foreach ($priceRanges as $range)
                <li>
                    <a href="{{ route('products', ['category' => request('category'), 'min_price' => $range['min'], 'max_price' => $range['max']]) }}"
                        class="block py-1 text-gray-700 hover:opacity-80 transition-colors duration-200 
                       {{ request('min_price') == $range['min'] && request('max_price') == $range['max'] ? 'font-bold' : '' }}">
                        {{ $range['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</aside>
