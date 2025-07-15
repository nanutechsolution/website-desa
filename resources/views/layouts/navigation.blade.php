<nav x-data="{ open: false, profileDropdownOpen: false }" class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        {{-- Ganti dengan logo SVG atau img tag Anda. Contoh SVG dari heroicons.com --}}
                        <svg class="block h-9 w-auto fill-current text-desa-green" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.47 2.47a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 4.06 5.03 11.03a.75.75 0 0 1-1.06-1.06l7.5-7.5Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M12 5.688l-7.5 7.5a.75.75 0 0 0-1.06 1.06l7.25 7.25a.75.75 0 0 0 1.06 0l7.25-7.25a.75.75 0 0 0-1.06-1.06L12 5.688Z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <span class="ml-2 text-xl font-bold text-gray-800">Desa Orakeri</span>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>

                    {{-- Dropdown Profil Desa --}}
                    <div class="relative" x-data="{ dropdownOpen: false }" @mouseenter="dropdownOpen = true"
                        @mouseleave="dropdownOpen = false">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out h-full"
                            :class="{'border-b-2 border-desa-skyblue': request()->routeIs('profil.*')}"
                            aria-haspopup="true" x-bind:aria-expanded="dropdownOpen">
                            {{ __('Profil Desa') }}
                            <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        {{-- Konten Dropdown --}}
                        <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0"
                            style="display: none;" @click.away="dropdownOpen = false">
                            <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                                <a href="{{ route('profil.visi') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Visi & Misi') }}
                                </a>
                                <a href="{{ route('profil.sejarah') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Sejarah Desa') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <x-nav-link :href="route('potentials')" :active="request()->routeIs('potentials')">{{ __('Potensi Desa') }}</x-nav-link>
                    <x-nav-link :href="route('news')" :active="request()->routeIs('news')">{{ __('Berita') }}</x-nav-link>
                    <x-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">{{ __('Galeri') }}</x-nav-link>
                    <x-nav-link :href="route('online-services')" :active="request()->routeIs('online-services')">{{ __('Layanan Online') }}</x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Kontak') }}</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth {{-- Hanya tampilkan ini jika pengguna sudah login --}}
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div> {{-- Aman karena sudah di dalam @auth --}}

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- Link ke Dashboard Admin --}}
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Dashboard Admin') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil Saya') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Keluar') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    {{-- Jika belum login, tampilkan link Login/Register --}}
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-desa-skyblue">Masuk</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-desa-skyblue">Daftar</a>
                    @endif
                @endauth
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
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

    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>

            {{-- Mobile Dropdown Profil Desa --}}
            <div x-data="{ mobileProfileOpen: false }">
                <button @click="mobileProfileOpen = ! mobileProfileOpen"
                    class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    {{ __('Profil Desa') }}
                    <svg class="ml-auto -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" :class="{ 'rotate-180': mobileProfileOpen }">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="mobileProfileOpen" class="space-y-1 pl-6 pt-2">
                    <x-responsive-nav-link :href="route('profil.visi')" :active="request()->routeIs('profil.visi')">
                        {{ __('Visi & Misi') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('profil.sejarah')" :active="request()->routeIs('profil.sejarah')">
                        {{ __('Sejarah Desa') }}
                    </x-responsive-nav-link>
                </div>
            </div>

            <x-responsive-nav-link :href="route('potentials')"
                :active="request()->routeIs('potentials')">{{ __('Potensi Desa') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('news')" :active="request()->routeIs('news')">{{ __('Berita') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('gallery')" :active="request()->routeIs('gallery')">{{ __('Galeri') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('online-services')"
                :active="request()->routeIs('online-services')">{{ __('Layanan Online') }}</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">{{ __('Kontak') }}</x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth {{-- Hanya tampilkan ini jika pengguna sudah login --}}
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    {{-- Link ke Dashboard Admin --}}
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        {{ __('Dashboard Admin') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profil Saya') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Keluar') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                {{-- Jika belum login, tampilkan link Login/Register (mobile) --}}
                <div class="space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Masuk') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Daftar') }}
                        </x-responsive-nav-link>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</nav>
