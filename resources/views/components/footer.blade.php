<footer class="bg-soft-gray text-dark-text py-12 mt-12 border-t border-gray-300 ">
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
                {{-- Ikon Media Sosial Dinamis --}}
                <div class="flex space-x-4 mt-4 text-xl text-secondary-dark">
                    {{-- Facebook --}}
                    @if ($socialMediaFacebook && $socialMediaFacebook->content)
                        <a href="{{ $socialMediaFacebook->content }}" target="_blank"
                            class="text-blue-500 hover:text-blue-600 transition-transform hover:scale-110 duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M279.14 288l14.22-92.66h-88.91V127.91c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S293.1 0 259.36 0C194.65 0 150.27 42.42 150.27 119.44V195.3H69.09V288h81.18v224h100.2V288z" />
                            </svg>
                        </a>
                    @endif

                    {{-- Instagram --}}
                    @if ($socialMediaInstagram && $socialMediaInstagram->content)
                        <a href="{{ $socialMediaInstagram->content }}" target="_blank"
                            class="text-pink-500 hover:text-pink-600 transition-transform hover:scale-110 duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9 114.9-51.3 114.9-114.9S287.7 141 224.1 141zm0 186.6c-39.6 0-71.7-32.1-71.7-71.7s32.1-71.7 71.7-71.7 71.7 32.1 71.7 71.7-32.1 71.7-71.7 71.7zm146.4-194.3c0 14.9-12.1 27-27 27s-27-12.1-27-27 12.1-27 27-27 27 12.1 27 27zm76.1 27.2c-1.7-35.7-9.9-67.3-36.3-92.7S369.4 7.3 333.7 5.6c-35.7-1.7-142.7-1.7-178.4 0-35.7 1.7-67.3 9.9-92.7 36.3S7.3 78.6 5.6 114.3c-1.7 35.7-1.7 142.7 0 178.4 1.7 35.7 9.9 67.3 36.3 92.7s57 34.6 92.7 36.3c35.7 1.7 142.7 1.7 178.4 0 35.7-1.7 67.3-9.9 92.7-36.3s34.6-57 36.3-92.7c1.7-35.7 1.7-142.7 0-178.4zM398.8 388c-7.8 19.7-23 35-42.7 42.7-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.7-7.8-35-23-42.7-42.7-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.7 23-35 42.7-42.7 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.7 7.8 35 23 42.7 42.7 11.7 29.5 9 99.5 9 132.1s2.6 102.7-9 132.1z" />
                            </svg>
                        </a>
                    @endif

                    {{-- Twitter --}}
                    @if ($socialMediaTwitter && $socialMediaTwitter->content)
                        <a href="{{ $socialMediaTwitter->content }}" target="_blank"
                            class="text-sky-500 hover:text-sky-600 transition-transform hover:scale-110 duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M459.4 151.7c.3 4.5.3 9.1.3 13.6 0 138.7-105.6 298.8-298.8 298.8-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.8 1.3 25.6 1.3 49.1 0 94.2-16.6 130-44.8-46.1-.8-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.7-1.3 27.5-3.6-48.1-9.7-84.2-52.1-84.2-103.2v-1.3c14 7.8 30.1 12.5 47.2 13.1-28-18.7-46.5-50.7-46.5-87.1 0-19.1 5.2-36.6 14.3-51.8 51.9 63.7 129.3 105.6 216.5 110.1-1.6-7.8-2.6-15.9-2.6-24 0-58.1 47.1-105.2 105.2-105.2 30.4 0 57.9 12.8 77.1 33.4 24.3-4.8 47.1-13.6 67.6-25.6-8 25-25 46-47.1 59.2 21.6-2.3 42.1-8.4 61.2-17-14.3 21.3-32.1 40.3-52.6 55.4z" />
                            </svg>
                        </a>
                    @endif

                    {{-- TikTok --}}
                    @if ($socialMediaTiktok && $socialMediaTiktok->content)
                        <a href="{{ $socialMediaTiktok->content }}" target="_blank"
                            class="text-gray-900 hover:text-black transition-transform hover:scale-110 duration-200">
                            <svg class="w-6 h-6 fill-current" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M448,209.8v95.5c-37.1,0-73.1-10.6-104.5-30.5v132.1c0,55.6-45.1,100.6-100.6,100.6h-34.4
                c-70.5,0-127.5-57-127.5-127.5V240.2c0-70.5,57-127.5,127.5-127.5h34.4v95.3h-34.4c-17.8,0-32.2,14.5-32.2,32.2v140.4
                c0,17.8,14.5,32.2,32.2,32.2h34.4c17.8,0,32.2-14.5,32.2-32.2V176.4c31.5,19.9,67.4,30.5,104.5,30.5z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Bawah Footer --}}
    <div class="mt-12 pt-6 border-t border-gray-300 text-center text-xs  text-dark-text/90">
        <p>&copy; {{ date('Y') }} {!! strip_tags($villageName->content) ?? 'Nama Desa' !!}. Hak Cipta Dilindungi.</p>
        <p class="mt-1 italic">
            Versi {{ config('app.version', '1.0.0') }} |
            Dibuat oleh
            <span class="text-primary font-medium">
                <a href="https://www.facebook.com/share/1BGG9pfRwU/?mibextid=qi2Omg" target="_blank"
                    rel="noopener noreferrer">
                    NanuTech Solution
                </a>
            </span>
        </p>
        <p class="mt-1">
            Ingin website desa seperti ini? Hubungi via
            <a href="https://wa.me/+6287750124895" class="underline text-primary hover:text-primary-dark transition"
                target="_blank">
                WhatsApp
            </a>
            atau kunjungi
            <a href="https://facebook.com/nanu.ranusate"
                class="underline text-primary hover:text-primary-dark transition" target="_blank">
                Facebook NanuTect Solution
            </a>
        </p>
    </div>
    </div>
</footer>
