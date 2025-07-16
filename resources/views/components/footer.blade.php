<footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            {{-- Kolom 1: Tentang Desa Orakeri (Dinamis) --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Desa Orakeri</h3>
                <p class="text-gray-400 text-sm">
                    {!! $footerAbout->content ?? 'Teks tentang desa belum diatur di admin.' !!}
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Visi & Misi</a></li>
                    <li><a href="{{ route('potentials') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Potensi Desa</a></li>
                    <li><a href="{{ route('news') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Berita</a></li>
                    <li><a href="{{ route('gallery') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Layanan</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('online-services') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Layanan Online</a>
                    </li>
                    <li><a href="{{ route('service-procedures') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Prosedur Layanan</a>
                    </li>
                    <li><a href="{{ route('documents') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Dokumen Publik</a>
                    </li>
                    <li><a href="{{ route('login') }}"
                            class="text-gray-400 hover:text-white transition-colors duration-200">Login Admin</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-desa-green">Informasi Kontak</h3>
                <p class="text-gray-400 mb-2">
                    @php
                        $contactAddress = App\Models\ProfileContent::where('key', 'contact_address')->first();
                        $contactEmail = App\Models\ProfileContent::where('key', 'contact_email')->first();
                        $contactPhone = App\Models\ProfileContent::where('key', 'contact_phone')->first();
                    @endphp
                    <strong class="">Alamat:</strong>
                <p class="text-gray-400 text-sm">{!! strip_tags($contactAddress->content) ?? 'Alamat belum diatur.' !!}</p>
                <br>
                <strong class="text-gray-400">Email:</strong>
                @if ($contactEmail && $contactEmail->content)
                    <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                        class="text-gray-400 hover:text-white transition-colors duration-200">{{ strip_tags($contactEmail->content) }}</a>
                @else
                    Email belum diatur.
                @endif
                <strong class="text-gray-400">Telepon:</strong>
                @php
                    $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
                @endphp
                @if ($contactPhone && $contactPhone->content)
                    <a href="tel:{{ $cleanPhoneNumber }}"
                        class="text-gray-400 hover:text-white transition-colors duration-200">{{ strip_tags($contactPhone->content) }}</a>
                @else
                    Telepon belum diatur.
                @endif
                </p>
                <div class="flex space-x-4 mt-4">
                    {{-- Ikon Media Sosial --}}
                    {{-- Pastikan Font Awesome dimuat di layouts/app.blade.php --}}
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        {{-- Hak Cipta --}}
        <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} Desa Orakeri. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
