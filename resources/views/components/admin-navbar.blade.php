<aside :class="{ '-translate-x-full': !$store.ui.sidebarOpen }"
    x-show="$store.ui.sidebarOpen || window.innerWidth >= 1024" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" @click.outside="$store.ui.closeSidebar()"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-xl lg:translate-x-0 lg:flex-shrink-0 lg:block overflow-y-auto transition-colors">

    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 h-16 flex items-center transition-colors">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $villageName->content }}</h2>
        <button @click="$store.ui.toggleSidebar()"
            class="lg:hidden ml-auto text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none transition-colors">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                </path>
            </svg>
        </button>
    </div>

    <nav class="mt-2 space-y-2 px-4">
        <ul class="space-y-1">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               group transition-colors duration-200 ease-in-out
                               {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    <span class="ms-3 font-medium">Dashboard</span>
                </a>
            </li>
            <li x-data="{ open: {{ request()->routeIs('admin.hero-sliders.*', 'admin.news.*', 'admin.galleries.*', 'admin.potentials.*', 'admin.products.*', 'admin.documents.*', 'admin.comments.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition-colors duration-200 ease-in-out">
                    <span class="ms-3 font-medium">Manajemen Konten</span>
                    <svg :class="{ 'rotate-90': open }"
                        class="w-4 h-4 transform transition-transform duration-200 text-gray-500 dark:text-gray-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>

                </button>
                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="mt-1 space-y-1 rounded-lg py-1 px-3
                               bg-gray-50 dark:bg-gray-700">

                    <li>
                        <a href="{{ route('admin.hero-sliders.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.hero-sliders.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Hero Slider
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.news.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Berita
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.galleries.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.galleries.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.potentials.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.potentials.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Potensi Desa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.products.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Produk Desa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.documents.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.documents.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Dokumen Publik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.comments.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.comments.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Moderasi Komentar
                        </a>
                    </li>
                </ul>
            </li>

            <li x-data="{ open: {{ request()->routeIs('admin.profile-contents.edit') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition-colors duration-200 ease-in-out">
                    <span class="ms-3 font-medium">Profil Desa</span>
                    <svg :class="{ 'rotate-90': open }"
                        class="w-4 h-4 transform transition-transform duration-200 text-gray-500 dark:text-gray-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="mt-1 space-y-1 rounded-lg py-1 px-3
                               bg-gray-50 dark:bg-gray-700">
                    <li>
                        <a href="{{ route('admin.profile-contents.edit', 'visi') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->route('key') == 'visi' ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Visi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile-contents.edit', 'misi') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->route('key') == 'misi' ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Misi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile-contents.edit', 'sejarah') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->route('key') == 'sejarah' ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Sejarah
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile-contents.edit', 'struktur_pemerintahan') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->route('key') == 'struktur_pemerintahan' ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Struktur Pemerintahan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile-contents.edit', 'sekilas_desa') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->route('key') == 'sekilas_desa' ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Sekilas Desa
                        </a>
                    </li>
                </ul>
            </li>

            <li x-data="{ open: {{ request()->routeIs('admin.service-procedures.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition-colors duration-200 ease-in-out">
                    <span class="ms-3 font-medium">Layanan Desa</span>
                    <svg :class="{ 'rotate-90': open }"
                        class="w-4 h-4 transform transition-transform duration-200 text-gray-500 dark:text-gray-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="mt-1 space-y-1 rounded-lg py-1 px-3
                               bg-gray-50 dark:bg-gray-700">
                    <li>
                        <a href="{{ route('admin.service-procedures.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.service-procedures.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Prosedur Layanan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.letter-generator.create') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.letter-generator.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Generator Surat
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('admin.institutions.index') }}"
                    class="flex items-center p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               group transition-colors duration-200 ease-in-out
                               {{ request()->routeIs('admin.institutions.*') ? 'bg-gray-100 dark:bg-gray-700 font-semibold' : '' }}">
                    <span class="ms-3 font-medium">Lembaga Desa</span>
                </a>
            </li>

            <hr class="border-gray-300 dark:border-gray-600 my-2">

            <li x-data="{ open: {{ request()->routeIs('admin.settings.*') || request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="flex items-center justify-between w-full p-2 rounded-lg
                               text-gray-700 dark:text-gray-200
                               hover:bg-gray-100 dark:hover:bg-gray-700
                               focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800
                               transition-colors duration-200 ease-in-out">
                    <span class="ms-3 font-medium">Pengaturan</span>
                    <svg :class="{ 'rotate-90': open }"
                        class="w-4 h-4 transform transition-transform duration-200 text-gray-500 dark:text-gray-400"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="mt-1 space-y-1 rounded-lg py-1 px-3
                               bg-gray-50 dark:bg-gray-700">
                    <li>
                        <a href="{{ route('admin.settings.edit-general-info') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.settings.edit-general-info') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Info Desa
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="block w-full p-2 rounded-md text-sm
                                      text-gray-700 dark:text-gray-200
                                      hover:bg-gray-200 dark:hover:bg-gray-600
                                      transition-colors duration-150 ease-in-out
                                      {{ request()->routeIs('admin.users.*') ? 'bg-gray-200 dark:bg-gray-600 font-semibold' : '' }}">
                            Manajemen Pengguna
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>
