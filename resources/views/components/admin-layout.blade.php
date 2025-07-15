<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dasbor Admin Desa Orakeri') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- TinyMCE CDN - TAMBAHKAN INI TEPAT SEBELUM </body> --}}
    <script src="https://cdn.tiny.cloud/1/algt269vr4aq8vf2pokvkxyplcwaofury8xlyeekzrg85v42/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    {{-- GANTI 'YOUR_TINYMCE_API_KEY' dengan kunci API Anda. --}}

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
            initializeTinyMCE('textarea#description'); // Untuk Produk Desa description
        });
    </script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }" @toggle-sidebar="sidebarOpen = !sidebarOpen">
        {{-- Overlay untuk Mobile (saat sidebar terbuka) --}}
        <div x-show="sidebarOpen" x-transition:opacity @click="sidebarOpen = false"
            class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden"></div>
        {{-- Sidebar Admin --}}
        <aside
            class="fixed top-0 left-0 z-40 w-64 h-full bg-gray-800 text-white p-4 space-y-4 shadow-lg flex-shrink-0
                       transform transition-transform duration-300 ease-in-out {{-- Hapus md:static di sini --}}
                       -translate-x-full md:translate-x-0"
            {{-- <- DEFAULT: tersembunyi, di MD: terlihat --}} :class="{ 'translate-x-0': sidebarOpen }"> {{-- <- HANYA terapkan 'translate-x-0' jika dibuka (untuk mobile) --}}
            <div class="text-2xl font-bold mb-6 text-center text-desa-green">Admin Orakeri</div>
            <nav>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-700 group {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
                            <span class="ms-3">Dashboard</span>
                        </a>
                    </li>

                    {{-- Dropdown Manajemen Konten --}}
                    <li x-data="{ contentOpen: {{ request()->routeIs('admin.hero-sliders.*', 'admin.news.*', 'admin.galleries.*', 'admin.potentials.*', 'admin.products.*', 'admin.documents.*') ? 'true' : 'false' }} }">
                        <button @click="contentOpen = !contentOpen"
                            class="flex items-center justify-between w-full p-2 rounded-lg text-white hover:bg-gray-700 group">
                            <span class="ms-3">Manajemen Konten</span>
                            <svg :class="{ 'rotate-90': contentOpen }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                        <ul x-show="contentOpen" x-transition class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li>
                                <a href="{{ route('admin.hero-sliders.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.hero-sliders.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Hero Slider</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.news.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.news.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Berita</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.galleries.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.galleries.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Galeri</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.potentials.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.potentials.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Potensi Desa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.products.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.products.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Produk Desa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.documents.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.documents.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Dokumen Publik</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.comments.index') }}"
                                    class="flex items-center p-2 rounded-lg dark:text-white hover:bg-gray-700 group {{ request()->routeIs('admin.comments.*') ? 'bg-gray-700' : '' }}">
                                    <span class="ms-3">Moderasi Komentar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Dropdown Profil Desa --}}
                    <li class="mt-4" x-data="{ profileOpen: {{ request()->routeIs('admin.profile-contents.edit') ? 'true' : 'false' }} }">
                        <button @click="profileOpen = !profileOpen"
                            class="flex items-center justify-between w-full p-2 rounded-lg text-white hover:bg-gray-700 group">
                            <span class="ms-3">Profil Desa</span>
                            <svg :class="{ 'rotate-90': profileOpen }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                        <ul x-show="profileOpen" x-transition class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li>
                                <a href="{{ route('admin.profile-contents.edit', 'visi') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.profile-contents.edit') && request()->route('key') == 'visi' ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Visi Desa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile-contents.edit', 'misi') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.profile-contents.edit') && request()->route('key') == 'misi' ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Misi Desa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile-contents.edit', 'sejarah') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.profile-contents.edit') && request()->route('key') == 'sejarah' ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Sejarah Desa</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile-contents.edit', 'struktur_pemerintahan') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.profile-contents.edit') && request()->route('key') == 'struktur_pemerintahan' ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Struktur Pemerintahan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.profile-contents.edit', 'sekilas_desa') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.profile-contents.edit') && request()->route('key') == 'sekilas_desa' ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Sekilas Desa</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Dropdown Layanan Desa --}}
                    <li class="mt-4" x-data="{ serviceOpen: {{ request()->routeIs('admin.service-procedures.*') ? 'true' : 'false' }} }">
                        <button @click="serviceOpen = !serviceOpen"
                            class="flex items-center justify-between w-full p-2 rounded-lg text-white hover:bg-gray-700 group">
                            <span class="ms-3">Layanan Desa</span>
                            <svg :class="{ 'rotate-90': serviceOpen }"
                                class="w-4 h-4 transform transition-transform duration-200" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                        <ul x-show="serviceOpen" x-transition class="mt-1 space-y-1 bg-gray-700 rounded-lg py-1 px-3">
                            <li>
                                <a href="{{ route('admin.service-procedures.index') }}"
                                    class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.service-procedures.*') ? 'bg-gray-600' : '' }}">
                                    <span class="ms-3">Prosedur Layanan</span>
                                </a>
                            </li>
                            {{-- Jika Anda membuat modul Pengajuan Surat (form yang diisi warga), bisa diletakkan di sini --}}
                            {{-- <li>
                                    <a href="{{ route('admin.service-requests.index') }}" class="flex items-center p-2 rounded-lg text-white hover:bg-gray-600 group {{ request()->routeIs('admin.service-requests.*') ? 'bg-gray-600' : '' }}">
                                        <span class="ms-3">Pengajuan Surat</span>
                                    </a>
                                </li> --}}
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col md:ml-64"> {{-- Tambahkan md:ml-64 untuk mengkompensasi sidebar di desktop --}}
            {{-- Navigasi Atas Admin --}}
            @include('layouts.admin-top-navigation')

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>

            {{-- Footer Admin --}}
            <footer class="bg-gray-800 text-white py-4 px-4 sm:px-6 lg:px-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Dasbor Admin Desa Orakeri. Hak Cipta Dilindungi.</p>
                <p class="mt-1">Ditenagai oleh Laravel & Tailwind CSS.</p>
            </footer>
        </div>
    </div>

    {{-- Script TinyMCE sudah ada di sini di body --}}
</body>

</html>
