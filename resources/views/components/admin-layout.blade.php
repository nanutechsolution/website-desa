<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="{{ config('app.description', 'Dasbor Admin Desa Orakeri') }}">
    <title>{{ config('app.name', 'Dasbor Admin Desa Orakeri') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <meta name="description" content="{{ $villageName ?? 'Website resmi Desa Orakeri.' }}">
    <title>{{ config('app.name', 'Laravel') }} - {{ $villageName ?? 'Nama Desa' }}</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/algt269vr4aq8vf2pokvkxyplcwaofury8xlyeekzrg85v42/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        // Fungsi untuk menginisialisasi TinyMCE
        function initializeTinyMCE(selector) {
            tinymce.init({
                selector: selector,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table paste code help wordcount nonbreaking hr pagebreak emoticons template codesample directionality print autoresize',
                toolbar: 'undo redo | formatselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media table | hr removeformat | preview fullscreen code | help',
                height: 500,
                menubar: 'file edit view insert format tools table help',
                statusbar: true,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: false,
                images_upload_url: '/admin/upload-editor-image', // Contoh endpoint upload Anda di Laravel
                automatic_uploads: true,
                file_picker_types: 'image',
                file_picker_callback: function(cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function() {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function() {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {
                                title: file.name
                            });
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                },
                content_style: 'body { font-family: Poppins, sans-serif; font-size:16px }'
            });
        }

        // Inisialisasi TinyMCE untuk textarea yang ada saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            initializeTinyMCE('textarea#content');
            initializeTinyMCE('textarea#steps_requirements');
            initializeTinyMCE('textarea#description_editor');
            initializeTinyMCE('textarea#description');
        });
    </script>
</head>

<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }" @toggle-sidebar="sidebarOpen = !sidebarOpen">
        {{-- Overlay untuk Mobile (saat sidebar terbuka) --}}
        <div x-show="sidebarOpen" x-transition:opacity @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-screen overflow-y-auto bg-gray-800 text-white p-4 space-y-4 shadow-lg transform transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0"
            :class="{ 'translate-x-0': sidebarOpen }">
            @php
                $villageName = App\Models\ProfileContent::where('key', 'village_name')->first();
            @endphp

            <div class="text-2xl font-bold mb-6 text-center text-desa-green">{{ strip_tags($villageName->content) }}
            </div>

            <nav>
                <ul class="space-y-1">

                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 rounded-lg hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    <!-- Manajemen Konten -->
                    <li x-data="{ open: {{ request()->routeIs('admin.hero-sliders.*', 'admin.news.*', 'admin.galleries.*', 'admin.potentials.*', 'admin.products.*', 'admin.documents.*', 'admin.comments.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-gray-700">
                            <span class="ms-3">Manajemen Konten</span>
                            <svg :class="{ 'rotate-90': open }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li><a href="{{ route('admin.hero-sliders.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.hero-sliders.*') ? 'bg-gray-600' : '' }}">Hero
                                    Slider</a></li>
                            <li><a href="{{ route('admin.news.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.news.*') ? 'bg-gray-600' : '' }}">Berita</a>
                            </li>
                            <li><a href="{{ route('admin.galleries.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.galleries.*') ? 'bg-gray-600' : '' }}">Galeri</a>
                            </li>
                            <li><a href="{{ route('admin.potentials.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.potentials.*') ? 'bg-gray-600' : '' }}">Potensi
                                    Desa</a></li>
                            <li><a href="{{ route('admin.products.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.products.*') ? 'bg-gray-600' : '' }}">Produk
                                    Desa</a></li>
                            <li><a href="{{ route('admin.documents.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.documents.*') ? 'bg-gray-600' : '' }}">Dokumen
                                    Publik</a></li>
                            <li><a href="{{ route('admin.comments.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.comments.*') ? 'bg-gray-600' : '' }}">Moderasi
                                    Komentar</a></li>
                        </ul>
                    </li>

                    <!-- Profil Desa -->
                    <li x-data="{ open: {{ request()->routeIs('admin.profile-contents.edit') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-gray-700">
                            <span class="ms-3">Profil Desa</span>
                            <svg :class="{ 'rotate-90': open }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li><a href="{{ route('admin.profile-contents.edit', 'visi') }}"
                                    class="menu-item {{ request()->route('key') == 'visi' ? 'bg-gray-600' : '' }}">Visi</a>
                            </li>
                            <li><a href="{{ route('admin.profile-contents.edit', 'misi') }}"
                                    class="menu-item {{ request()->route('key') == 'misi' ? 'bg-gray-600' : '' }}">Misi</a>
                            </li>
                            <li><a href="{{ route('admin.profile-contents.edit', 'sejarah') }}"
                                    class="menu-item {{ request()->route('key') == 'sejarah' ? 'bg-gray-600' : '' }}">Sejarah</a>
                            </li>
                            <li><a href="{{ route('admin.profile-contents.edit', 'struktur_pemerintahan') }}"
                                    class="menu-item {{ request()->route('key') == 'struktur_pemerintahan' ? 'bg-gray-600' : '' }}">Struktur
                                    Pemerintahan</a></li>
                            <li><a href="{{ route('admin.profile-contents.edit', 'sekilas_desa') }}"
                                    class="menu-item {{ request()->route('key') == 'sekilas_desa' ? 'bg-gray-600' : '' }}">Sekilas
                                    Desa</a></li>
                        </ul>
                    </li>


                    <!-- Layanan Desa -->
                    <li x-data="{ open: {{ request()->routeIs('admin.service-procedures.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-gray-700">
                            <span class="ms-3">Layanan Desa</span>
                            <svg :class="{ 'rotate-90': open }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li><a href="{{ route('admin.service-procedures.index') }}"
                                    class="menu-item {{ request()->routeIs('admin.service-procedures.*') ? 'bg-gray-600' : '' }}">Prosedur
                                    Layanan</a></li>
                        </ul>
                    </li>
                    {{-- di dalam ul untuk Manajemen Konten --}}
                    <li>
                        <a href="{{ route('admin.institutions.index') }}"
                            class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.institutions.*') ? 'bg-gray-600' : '' }}">
                            <span class="ms-3">Lembaga Desa</span>
                        </a>
                    </li>
                    <hr class="border-gray-600 my-2">
                    <li x-data="{ open: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                        <button @click="open = !open"
                            class="flex items-center justify-between w-full p-2 rounded-lg hover:bg-gray-700">
                            <span class="ms-3">Pengaturan</span>
                            <svg :class="{ 'rotate-90': open }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <ul x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li x-data="{ open: {{ request()->routeIs('admin.settings.edit-general-info') || in_array(request()->route('key'), ['village_name', 'contact_address', 'Maps_coords', 'footer_about', 'contact_phone', 'contact_email', 'site_meta_description']) ? 'true' : 'false' }} }"> {{-- Logic untuk buka dropdown --}}
                                <a href="{{ route('admin.settings.edit-general-info') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group {{ request()->routeIs('admin.settings.edit-general-info') ? 'bg-gray-700' : '' }}">
                                    <span class="ms-3">Info Desa</span>
                                </a>
                            </li>
                            {{-- menejemen user --}}
                            <li x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }">
                                <a href="{{ route('admin.users.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-700 group {{ request()->routeIs('admin.users.*') ? 'bg-gray-700' : '' }}">
                                    <span class="ms-3">Manajemen Pengguna</span>
                                </a>
                            </li>
                        </ul>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col md:ml-64">
            @include('layouts.admin-top-navigation')
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <main class="">
                {{ $slot }}
            </main>
            <footer
                class="bg-gray-900 text-gray-300 py-6 px-4 sm:px-6 lg:px-8 text-center text-sm border-t border-gray-700">
                @php
                    $villageName = App\Models\ProfileContent::where('key', 'village_name')->first();
                @endphp

                <div class="space-y-2">
                    <p class="text-white font-semibold text-base">
                        &copy; {{ date('Y') }} {!! strip_tags($villageName->content) !!}. Semua hak cipta dilindungi.
                    </p>

                    <p>
                        Dibangun dengan ❤️ menggunakan <span class="text-blue-400">Laravel</span> & <span
                            class="text-teal-400">Tailwind CSS</span>
                    </p>

                    <p>
                        Versi <span class="font-mono text-yellow-300">{{ config('app.version', '1.0.0') }}</span>
                    </p>

                    <p class="italic text-gray-400">
                        Made with care by <span class="text-pink-400 font-semibold">Tim Nanu Group</span>
                    </p>
                </div>
            </footer>

        </div>
    </div>
</body>

</html>
