<footer class="bg-gray-100 text-gray-700 py-12 mt-12 border-t border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Kolom 1: Tentang Desa --}}
            <div>
                <h3 class="text-xl font-semibold mb-4 text-desa-green">
                    {{ strip_tags($villageName->content) ?? 'Nama Desa' }}
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {!! $footerAbout->content ?? 'Teks tentang desa belum diatur di admin.' !!}
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="text-xl font-semibold mb-4 text-desa-green">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-desa-green">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}" class="hover:text-desa-green">Visi & Misi</a></li>
                    <li><a href="{{ route('potentials') }}" class="hover:text-desa-green">Potensi Desa</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-desa-green">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="hover:text-desa-green">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h3 class="text-xl font-semibold mb-4 text-desa-green">Layanan</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('online-services') }}" class="hover:text-desa-green">Layanan Online</a></li>
                    <li><a href="{{ route('service-procedures') }}" class="hover:text-desa-green">Prosedur Layanan</a>
                    </li>
                    <li><a href="{{ route('documents') }}" class="hover:text-desa-green">Dokumen Publik</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-desa-green">Login Admin</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h3 class="text-xl font-semibold mb-4 text-desa-green">Kontak</h3>
                <div class="text-sm text-gray-600 space-y-1">
                    @php
                        $contactAddress = App\Models\ProfileContent::where('key', 'contact_address')->first();
                        $contactEmail = App\Models\ProfileContent::where('key', 'contact_email')->first();
                        $contactPhone = App\Models\ProfileContent::where('key', 'contact_phone')->first();
                        $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
                    @endphp

                    <p><strong>Alamat:</strong><br> {!! strip_tags($contactAddress->content) ?? 'Alamat belum diatur.' !!}</p>

                    <p><strong>Email:</strong><br>
                        @if ($contactEmail && $contactEmail->content)
                            <a href="mailto:{{ strip_tags($contactEmail->content) }}" class="hover:text-desa-green">
                                {{ strip_tags($contactEmail->content) }}
                            </a>
                        @else
                            Email belum diatur.
                        @endif
                    </p>

                    <p><strong>Telepon:</strong><br>
                        @if ($contactPhone && $contactPhone->content)
                            <a href="tel:{{ $cleanPhoneNumber }}" class="hover:text-desa-green">
                                {{ strip_tags($contactPhone->content) }}
                            </a>
                        @else
                            Telepon belum diatur.
                        @endif
                    </p>
                </div>

                <div class="flex space-x-4 mt-4 text-lg text-gray-500">
                    <a href="#" class="hover:text-blue-500"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-sky-500"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div class="mt-10 pt-6 border-t border-gray-300 text-center text-xs text-gray-500">
            <p>&copy; {{ date('Y') }} {!! strip_tags($villageName->content) ?? 'Nama Desa' !!}. Hak Cipta Dilindungi.</p>

            <p class="mt-1 italic">
                Versi {{ config('app.version', '1.0.0') }} |
                Dibuat dengan ❤️ oleh
                <span class="text-desa-green font-semibold">
                    <a href="https://www.facebook.com/share/1BGG9pfRwU/?mibextid=qi2Omg" target="_blank"
                        rel="noopener noreferrer">
                        Tim Nanu Group
                    </a>
                </span>
            </p>

            <p class="mt-1">
                Ingin website desa seperti ini? Hubungi kami via <a href="https://wa.me/6281234567890" target="_blank"
                    rel="noopener noreferrer" class="underline text-blue-600 hover:text-blue-800">WhatsApp</a>
                atau kunjungi <a href="https://facebook.com/nanugroup" target="_blank" rel="noopener noreferrer"
                    class="underline text-blue-600 hover:text-blue-800">Facebook Nanu Group</a>
            </p>
        </div>

    </div>
</footer>
