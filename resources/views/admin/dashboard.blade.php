<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard Admin Desa Orakeri') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="dark:bg-grey overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('Selamat datang di Dasbor Admin Desa Orakeri!') }}
                    <p class="mt-4">Di sini Anda bisa mengelola konten website desa.</p>
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-desa-green text-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-bold mb-2">Kelola Hero Slider</h3>
                            <p class="text-sm">Tambahkan, edit, atau hapus slide tampilan beranda.</p>
                            <a href="{{ route('admin.hero-sliders.index') }}"
                                class="mt-3 inline-block bg-white text-desa-green px-4 py-2 rounded hover:bg-gray-200">Lihat
                                Slider</a>
                        </div>

                        <div class="bg-desa-skyblue text-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-bold mb-2">Manajemen Berita</h3>
                            <p class="text-sm">Publikasikan berita terbaru desa.</p>
                            <a href="#"
                                class="mt-3 inline-block bg-white text-desa-skyblue px-4 py-2 rounded hover:bg-gray-200">Kelola
                                Berita</a>
                        </div>

                        <div class="bg-desa-brown text-white p-6 rounded-lg shadow">
                            <h3 class="text-xl font-bold mb-2">Layanan Online</h3>
                            <p class="text-sm">Proses permintaan surat dari warga.</p>
                            <a href="#"
                                class="mt-3 inline-block bg-white text-desa-brown px-4 py-2 rounded hover:bg-gray-200">Lihat
                                Permintaan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-admin-layout>
