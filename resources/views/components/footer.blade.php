<footer class="gradient-bg text-white py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- Kolom 1: Tentang Desa Orakeri --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Desa Orakeri</h3>
                <p class="text-white-400 text-sm">
                    Desa Orakeri adalah sebuah komunitas yang kaya akan budaya dan potensi alam. Kami berkomitmen untuk
                    membangun desa yang mandiri, sejahtera, dan lestari.
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Visi & Misi</a></li>
                    <li><a href="{{ route('potentials') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Potensi Desa</a></li>
                    <li><a href="{{ route('news') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Berita</a></li>
                    <li><a href="{{ route('gallery') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('online-services') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Layanan Online</a>
                    </li>
                    <li><a href="{{ route('contact') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Kontak Kami</a></li>
                    <li><a href="{{ route('login') }}"
                            class="text-white-400 hover:text-white transition-colors duration-200">Login Admin</a></li>
                    {{-- Tambahkan link layanan lain --}}
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Informasi Kontak</h3>
                <p class="text-white-400 text-sm mb-2">
                    Jl. Raya Desa Orakeri No. 123 <br>
                    Kecamatan, Kabupaten, Provinsi <br>
                    Kode Pos: XXXX
                </p>
                <p class="text-white-400 text-sm mb-2">
                    Email: <a href="mailto:info@desaorakeri.com" class="hover:text-white">info@desaorakeri.com</a>
                </p>
                <p class="text-white-400 text-sm">
                    Telepon: (0274) XXXX XXXX
                </p>
                <div class="flex space-x-4 mt-4">
                    {{-- Ikon Media Sosial (contoh: Facebook, Instagram) --}}
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        {{-- Hak Cipta --}}
        <div class="border-t border-white-700 mt-8 pt-6 text-center text-white-500 text-sm">
            &copy; {{ date('Y') }} Desa Orakeri. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
