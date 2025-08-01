<footer class="bg-soft-gray text-dark-text py-12 mt-12 border-t border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            {{-- Kolom 1: Tentang Desa --}}
            <div>
                <h3 class="text-xl font-bold mb-4 text-primary">
                    {{ strip_tags($villageName->content) ?? 'Nama Desa' }}
                </h3>
                <p class="text-sm leading-relaxed text-dark-text/80">
                    {!! $footerAbout->content ?? 'Teks tentang desa belum diatur di admin.' !!}
                </p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="transition hover:text-primary-dark">Beranda</a></li>
                    <li><a href="{{ route('profil.visi') }}" class="transition hover:text-primary-dark">Visi & Misi</a>
                    </li>
                    <li><a href="{{ route('potentials') }}" class="transition hover:text-primary-dark">Potensi Desa</a>
                    </li>
                    <li><a href="{{ route('news') }}" class="transition hover:text-primary-dark">Berita</a></li>
                    <li><a href="{{ route('gallery') }}" class="transition hover:text-primary-dark">Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Layanan</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('online-services') }}" class="transition hover:text-primary-dark">Layanan
                            Online</a></li>
                    <li><a href="{{ route('service-procedures') }}" class="transition hover:text-primary-dark">Prosedur
                            Layanan</a></li>
                    <li><a href="{{ route('documents') }}" class="transition hover:text-primary-dark">Dokumen Publik</a>
                    </li>
                    <li><a href="{{ route('login') }}" class="transition hover:text-primary-dark">Login Admin</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kontak --}}
            <div>
                <h4 class="text-lg font-semibold mb-3 text-primary">Kontak</h4>
                <div class="text-sm space-y-2 text-dark-text/80">
                    @php
                        $contactAddress = App\Models\ProfileContent::where('key', 'contact_address')->first();
                        $contactEmail = App\Models\ProfileContent::where('key', 'contact_email')->first();
                        $contactPhone = App\Models\ProfileContent::where('key', 'contact_phone')->first();
                        $cleanPhoneNumber = preg_replace('/[^0-9+]/', '', $contactPhone->content ?? '');
                    @endphp

                    <p>
                        <strong>Alamat:</strong><br>
                        {!! strip_tags($contactAddress->content) ?? 'Alamat belum diatur.' !!}
                    </p>
                    <p>
                        <strong>Email:</strong><br>
                        @if ($contactEmail && $contactEmail->content)
                            <a href="mailto:{{ strip_tags($contactEmail->content) }}"
                                class="hover:text-primary-dark underline">
                                {{ strip_tags($contactEmail->content) }}
                            </a>
                        @else
                            Email belum diatur.
                        @endif
                    </p>
                    <p>
                        <strong>Telepon:</strong><br>
                        @if ($contactPhone && $contactPhone->content)
                            <a href="tel:{{ $cleanPhoneNumber }}" class="hover:text-primary-dark underline">
                                {{ strip_tags($contactPhone->content) }}
                            </a>
                        @else
                            Telepon belum diatur.
                        @endif
                    </p>
                </div>

                {{-- Icon Sosmed --}}
                <div class="flex space-x-4 mt-4 text-xl text-secondary-dark">
                    <a href="#" class="hover:text-blue-500 transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-pink-500 transition"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-sky-500 transition"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>

        {{-- Bawah Footer --}}
        <div class="mt-12 pt-6 border-t border-gray-300 text-center text-xs text-dark-text/60">
            <p>&copy; {{ date('Y') }} {!! strip_tags($villageName->content) ?? 'Nama Desa' !!}. Hak Cipta Dilindungi.</p>

            <p class="mt-1 italic">
                Versi {{ config('app.version', '1.0.0') }} |
                Dibuat dengan ❤️ oleh
                <span class="text-primary font-medium">
                    <a href="https://www.facebook.com/share/1BGG9pfRwU/?mibextid=qi2Omg" target="_blank"
                        rel="noopener noreferrer">
                        NanuTech Solution
                    </a>
                </span>
            </p>

            <p class="mt-1">
                Ingin website desa seperti ini? Hubungi via
                <a href="https://wa.me/#" class="underline text-accent hover:text-accent-dark transition"
                    target="_blank">
                    WhatsApp
                </a>
                atau kunjungi
                <a href="https://facebook.com/nanu.ranusate"
                    class="underline text-accent hover:text-accent-dark transition" target="_blank">
                    Facebook NanuTect Solution
                </a>
            </p>
        </div>
    </div>
</footer>
