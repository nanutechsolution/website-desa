<x-admin-layout>
    {{-- Anda telah mengomentari x-slot header. Jika Anda ingin header di dashboard, aktifkan kembali --}}
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight transition-colors">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg transition-colors duration-300">
                <div class="p-6 text-gray-900 dark:text-gray-100 transition-colors duration-300">
                    <div class="flex items-center mb-6">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                class="h-16 w-16 rounded-full object-cover mr-4 shadow-md">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF"
                                alt="{{ Auth::user()->name }}"
                                class="h-16 w-16 rounded-full object-cover mr-4 shadow-md">
                        @endif
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white transition-colors">Selamat Datang,
                            {{ Auth::user()->name }}!</h3>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Statistik Umum --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 transition-colors">Statistik
                        Situs</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        {{-- Card Berita Artikel --}}
                        <div
                            class="bg-green-600 dark:bg-green-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalNews }}</div>
                                <div class="text-sm opacity-90">Berita Artikel</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v10m-3 0l-3-3m0 0l-3 3m3-3v11M17 12h.01M17 16h.01">
                                </path>
                            </svg>
                        </div>
                        {{-- Card Produk Desa --}}
                        <div
                            class="bg-blue-600 dark:bg-blue-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalProducts }}</div>
                                <div class="text-sm opacity-90">Produk Desa</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6a2 2 0 00-2-2H5a2 2 0 00-2 2v13a2 2 0 002 2h4a2 2 0 002-2zm0 0h6m-6 0h6m6 0V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v13a2 2 0 002 2h4a2 2 0 002-2z">
                                </path>
                            </svg>
                        </div>
                        {{-- Card Album Galeri --}}
                        <div
                            class="bg-purple-600 dark:bg-purple-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalGalleries }}</div>
                                <div class="text-sm opacity-90">Album Galeri</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        {{-- Card Dokumen Publik --}}
                        <div
                            class="bg-red-600 dark:bg-red-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalDocuments }}</div>
                                <div class="text-sm opacity-90">Dokumen Publik</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        {{-- Card Agenda Kegiatan --}}
                        <div
                            class="bg-teal-600 dark:bg-teal-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalEvents }}</div>
                                <div class="text-sm opacity-90">Agenda Kegiatan</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h.01M16 11h.01M9 15h.01M15 15h.01M9 19h.01M15 19h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        {{-- Card Lembaga Desa --}}
                        <div
                            class="bg-orange-600 dark:bg-orange-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalInstitutions }}</div>
                                <div class="text-sm opacity-90">Lembaga Desa</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="currentColor" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h2a2 2 0 002-2V9a2 2 0 00-2-2h-2M5 5a2 2 0 00-2 2v12a2 2 0 002 2h2m0-6h6m-6 0v6m6-3v3m-6-3h.01M17 12h.01M12 21V9m0 0a2 2 0 00-2-2H7a2 2 0 00-2 2v12m7 0a2 2 0 012-2h2a2 2 0 012 2v12m-7 0a2 2 0 012-2h2a2 2 0 012 2v12">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div
                        class="bg-indigo-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105  duration-200">
                        <div>
                            <div class="text-3xl font-bold">{{ $totalVisits }}</div>
                            <div class="text-sm">Total Kunjungan</div>
                            <div class="text-xs opacity-75 mt-1">{{ $uniqueVisitors }} Pengunjung Unik</div>
                        </div>
                        <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10V6"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 12h4"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 2a9 9 0 100 18 9 9 0 000-18z"></path>
                        </svg>
                    </div>
                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Statistik Layanan & Moderasi --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 mt-8 transition-colors">
                        Status Layanan & Moderasi</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        {{-- Card Pengajuan Surat Pending --}}
                        <div
                            class="bg-yellow-500 dark:bg-yellow-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingServiceRequests }}</div>
                                <div class="text-sm opacity-90">Pengajuan Surat Pending</div>
                            </div>
                            <a href="#"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                        {{-- Card Komentar Pending --}}
                        <div
                            class="bg-red-500 dark:bg-red-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingComments }}</div>
                                <div class="text-sm opacity-90">Komentar Pending</div>
                            </div>
                            <a href="{{ route('admin.comments.index') }}"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                        {{-- Card Prosedur Layanan --}}
                        <div
                            class="bg-indigo-600 dark:bg-indigo-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105 duration-200">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalServiceProcedures }}</div>
                                <div class="text-sm opacity-90">Prosedur Layanan</div>
                            </div>
                            <a href="{{ route('admin.service-procedures.index') }}"
                                class="text-white text-sm font-semibold underline hover:no-underline transition-colors">Lihat
                                &rarr;</a>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700 my-8 transition-colors">

                    {{-- Bagian Aktivitas Terbaru --}}
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 mt-8 transition-colors">
                        Aktivitas & Data Terbaru</h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 transition-colors">
                                Berita Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestNews as $newsItem)
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center justify-between transition-colors duration-200">
                                        <div>
                                            <a href="{{ route('admin.news.edit', $newsItem) }}"
                                                class="text-gray-800 dark:text-gray-100 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ Str::limit($newsItem->title, 50) }}
                                            </a>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $newsItem->published_at ? $newsItem->published_at->format('d M Y H:i') : 'Draft' }}
                                            </p>
                                        </div>
                                        @if ($newsItem->is_published)
                                            <span
                                                class="px-2.5 py-0.5 bg-green-500 text-white text-xs font-medium rounded-full">Terbit</span>
                                        @else
                                            <span
                                                class="px-2.5 py-0.5 bg-yellow-500 text-white text-xs font-medium rounded-full">Draft</span>
                                        @endif
                                    </li>
                                @empty
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                        Tidak ada berita terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($totalNews > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.news.index') }}"
                                        class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                        Semua Berita &rarr;</a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 transition-colors">
                                Pengajuan Surat Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestServiceRequests as $requestItem)
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm flex items-center justify-between transition-colors duration-200">
                                        <div>
                                            <a href="{{ route('admin.service-requests.show', $requestItem) }}"
                                                class="text-gray-800 dark:text-gray-100 font-medium hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                                {{ Str::limit($requestItem->jenis_surat, 40) }}
                                            </a>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $requestItem->nama }} -
                                                {{ $requestItem->created_at->format('d M Y H:i') }}
                                            </p>
                                        </div>
                                        @php
                                            $statusClass =
                                                [
                                                    'pending' => 'bg-yellow-500',
                                                    'diproses' => 'bg-blue-500',
                                                    'selesai' => 'bg-green-500',
                                                    'ditolak' => 'bg-red-500',
                                                ][$requestItem->status] ?? 'bg-gray-500';
                                        @endphp
                                        <span
                                            class="px-2.5 py-0.5 {{ $statusClass }} text-white text-xs font-medium rounded-full">
                                            {{ ucfirst($requestItem->status) }}
                                        </span>
                                    </li>
                                @empty
                                    <li
                                        class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                        Tidak ada pengajuan surat terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($pendingServiceRequests > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.service-requests.index') }}"
                                        class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                        Semua Pengajuan &rarr;</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Komentar Pending Terbaru --}}
                    <h5 class="text-lg font-semibold text-gray-700 dark:text-gray-300 mb-3 mt-8 transition-colors">
                        Komentar Pending Terbaru</h5>
                    <ul class="space-y-3">
                        @forelse($latestComments as $commentItem)
                            <li
                                class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm transition-colors duration-200">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="font-medium text-gray-800 dark:text-gray-100">
                                        {{ $commentItem->guest_name ?? ($commentItem->user->name ?? 'Anonim') }}
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $commentItem->created_at->diffForHumans() }}</p>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-200 mb-2">
                                    {{ Str::limit($commentItem->content, 100) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pada artikel:
                                    <a href="{{ route('news.show', $commentItem->news->slug) }}" target="_blank"
                                        class="text-blue-600 dark:text-blue-400 hover:underline transition-colors">
                                        {{ Str::limit($commentItem->news->title, 40) }}
                                    </a>
                                </p>
                                <div class="text-right mt-2">
                                    <a href="{{ route('admin.comments.index') }}"
                                        class="text-green-600 dark:text-green-400 text-xs hover:underline transition-colors">Moderasi
                                        &rarr;</a>
                                </div>
                            </li>
                        @empty
                            <li
                                class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-500 dark:text-gray-400 text-sm transition-colors">
                                Tidak ada komentar pending.</li>
                        @endforelse
                    </ul>
                    @if ($pendingComments > 0)
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.comments.index') }}"
                                class="text-blue-600 dark:text-blue-400 text-sm hover:underline transition-colors">Lihat
                                Semua Komentar Pending &rarr;</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
