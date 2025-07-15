<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-desa-green-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- LOGO --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 text-white font-bold">
                    <svg class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M11.47 2.47a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 4.06 5.03 11.03a.75.75 0 0 1-1.06-1.06l7.5-7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Desa Orakeri</span>
                </a>
            </div>

            {{-- MENU UTAMA --}}
            <div class="hidden sm:flex space-x-6 items-center">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')"
                    class="text-white hover:text-yellow-200">Beranda</x-nav-link>

                {{-- DROPDOWN PROFIL --}}
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 text-white hover:text-yellow-200 transition">
                        Profil Desa
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.92l3.71-3.71a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition
                        class="absolute left-0 mt-2 w-48 bg-white rounded shadow-lg z-50 text-sm text-gray-800">
                        <a href="{{ route('profil.visi') }}" class="block px-4 py-2 hover:bg-gray-100">Visi & Misi</a>
                        <a href="{{ route('profil.sejarah') }}" class="block px-4 py-2 hover:bg-gray-100">Sejarah</a>
                        <a href="{{ route('profil.struktur') }}" class="block px-4 py-2 hover:bg-gray-100">Struktur</a>
                    </div>
                </div>

                {{-- DROPDOWN LAYANAN --}}
                <div x-data="{ open: false }" class="relative" @mouseenter="open = true" @mouseleave="open = false">
                    <button class="flex items-center gap-1 text-white hover:text-yellow-200 transition">
                        Layanan Desa
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.92l3.71-3.71a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition
                        class="absolute left-0 mt-2 w-56 bg-white rounded shadow-lg z-50 text-sm text-gray-800">
                        <a href="{{ route('online-services') }}" class="block px-4 py-2 hover:bg-gray-100">Ajukan Surat
                            Online</a>
                        <a href="{{ route('documents') }}" class="block px-4 py-2 hover:bg-gray-100">Unduh Dokumen</a>
                        <a href="{{ route('service-procedures') }}" class="block px-4 py-2 hover:bg-gray-100">Prosedur
                            Layanan</a>
                    </div>
                </div>

                {{-- MENU UTAMA LAINNYA --}}
                <x-nav-link :href="route('potentials')" :active="request()->routeIs('potentials')"
                    class="text-white hover:text-yellow-200">Potensi</x-nav-link>
                <x-nav-link :href="route('news')" :active="request()->routeIs('news')"
                    class="text-white hover:text-yellow-200">Berita</x-nav-link>
                <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')"
                    class="text-white hover:text-yellow-200">Galeri</x-nav-link>
                <x-nav-link :href="route('products')" :active="request()->routeIs('products')"
                    class="text-white hover:text-yellow-200">Produk</x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')"
                    class="text-white hover:text-yellow-200">Kontak</x-nav-link>
            </div>

            {{-- AUTH USER --}}
            <div class="flex items-center space-x-4">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="text-white hover:text-yellow-200 flex items-center space-x-1">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 fill-current" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.92l3.71-3.71a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('admin.dashboard')">Dashboard</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">Profil</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Keluar</x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-yellow-200">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white hover:text-yellow-200">Daftar</a>
                    @endif
                @endauth

                {{-- TOGGLE BUTTON MOBILE --}}
                <button @click="open = !open" class="sm:hidden text-white hover:text-yellow-200 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU DROPDOWN --}}
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-desa-green-800">
        <div class="px-4 pt-4 pb-4 space-y-2 text-white">
            <x-responsive-nav-link :href="route('home')">Beranda</x-responsive-nav-link>

            {{-- Profil Desa Dropdown Mobile --}}
            <div x-data="{ profileMobileOpen: false }">
                <button @click="profileMobileOpen = !profileMobileOpen"
                    class="flex w-full justify-between items-center">
                    <span>Profil Desa</span>
                    <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': profileMobileOpen }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.92l3.71-3.71a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="profileMobileOpen" class="pl-4 mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('profil.visi')">Visi & Misi</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profil.sejarah')">Sejarah</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profil.struktur')">Struktur</x-responsive-nav-link>
                </div>
            </div>

            {{-- Layanan Dropdown Mobile --}}
            <div x-data="{ layananMobileOpen: false }">
                <button @click="layananMobileOpen = !layananMobileOpen"
                    class="flex w-full justify-between items-center">
                    <span>Layanan Desa</span>
                    <svg class="w-5 h-5 transform transition-transform" :class="{ 'rotate-180': layananMobileOpen }"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 0 1 1.06 0L10 10.92l3.71-3.71a.75.75 0 0 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.23 8.27a.75.75 0 0 1 0-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="layananMobileOpen" class="pl-4 mt-2 space-y-1">
                    <x-responsive-nav-link :href="route('online-services')">Ajukan Surat</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('documents')">Unduh Dokumen</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('service-procedures')">Prosedur</x-responsive-nav-link>
                </div>
            </div>

            <x-responsive-nav-link :href="route('potentials')">Potensi</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('news')">Berita</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gallery')">Galeri</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products')">Produk</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')">Kontak</x-responsive-nav-link>

            @auth
                <div class="border-t border-white pt-3">
                    <x-responsive-nav-link :href="route('admin.dashboard')">Dashboard</x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profile.edit')">Profil</x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">Keluar</x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="border-t border-white pt-3">
                    <x-responsive-nav-link :href="route('login')">Masuk</x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">Daftar</x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
