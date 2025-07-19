<x-admin-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8"> {{-- Gunakan max-w-full untuk lebar penuh --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6 text-desa-brown">Selamat Datang, {{ Auth::user()->name }}!</h3>

                    {{-- Bagian Statistik Umum --}}
                    <h4 class="text-xl font-semibold text-dark-text mb-4">Statistik Situs</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                        <div
                            class="bg-desa-green-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalNews }}</div>
                                <div class="text-sm">Berita Artikel</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v10m-3 0l-3-3m0 0l-3 3m3-3v11M17 12h.01M17 16h.01">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="bg-desa-skyblue text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalProducts }}</div>
                                <div class="text-sm">Produk Desa</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6a2 2 0 00-2-2H5a2 2 0 00-2 2v13a2 2 0 002 2h4a2 2 0 002-2zm0 0h6m-6 0h6m6 0V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v13a2 2 0 002 2h4a2 2 0 002-2z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="bg-desa-brown text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalGalleries }}</div>
                                <div class="text-sm">Album Galeri</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="bg-gray-700 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalDocuments }}</div>
                                <div class="text-sm">Dokumen Publik</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="bg-blue-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalEvents }}</div>
                                <div class="text-sm">Agenda Kegiatan</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h.01M16 11h.01M9 15h.01M15 15h.01M9 19h.01M15 19h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="bg-yellow-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalInstitutions }}</div>
                                <div class="text-sm">Lembaga Desa</div>
                            </div>
                            <svg class="h-10 w-10 opacity-75" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h2a2 2 0 002-2V9a2 2 0 00-2-2h-2M5 5a2 2 0 00-2 2v12a2 2 0 002 2h2m0-6h6m-6 0v6m6-3v3m-6-3h.01M17 12h.01M12 21V9m0 0a2 2 0 00-2-2H7a2 2 0 00-2 2v12m7 0a2 2 0 012-2h2a2 2 0 012 2v12m-7 0a2 2 0 012-2h2a2 2 0 012 2v12">
                                </path>
                            </svg>
                        </div>
                    </div>

                    {{-- Bagian Statistik Layanan & Moderasi --}}
                    <h4 class="text-xl font-semibold text-dark-text mb-4 mt-8">Status Layanan & Moderasi</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div
                            class="bg-yellow-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingServiceRequests }}</div>
                                <div class="text-sm">Pengajuan Surat Pending</div>
                            </div>
                            <a href="#" class="text-white text-xs underline hover:no-underline">Lihat &rarr;</a>
                        </div>
                        <div
                            class="bg-red-500 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $pendingComments }}</div>
                                <div class="text-sm">Komentar Pending</div>
                            </div>
                            <a href="{{ route('admin.comments.index') }}"
                                class="text-white text-xs underline hover:no-underline">Lihat &rarr;</a>
                        </div>
                        <div
                            class="bg-purple-600 text-white p-6 rounded-lg shadow-lg flex items-center justify-between transition-transform transform hover:scale-105">
                            <div>
                                <div class="text-3xl font-bold">{{ $totalServiceProcedures }}</div>
                                <div class="text-sm">Prosedur Layanan</div>
                            </div>
                            <a href="{{ route('admin.service-procedures.index') }}"
                                class="text-white text-xs underline hover:no-underline">Lihat &rarr;</a>
                        </div>
                    </div>

                    {{-- Bagian Aktivitas Terbaru --}}
                    <h4 class="text-xl font-semibold text-dark-text mb-4 mt-8">Aktivitas & Data Terbaru</h4>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <h5 class="text-lg font-semibold mb-3">Berita Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestNews as $newsItem)
                                    <li class="p-3 bg-gray-50 rounded-lg flex items-center justify-between">
                                        <div>
                                            <a href="{{ route('admin.news.edit', $newsItem) }}"
                                                class="text-dark-text font-medium hover:text-desa-skyblue">{{ Str::limit($newsItem->title, 50) }}</a>
                                            <p class="text-xs text-gray-500">
                                                {{ $newsItem->published_at->format('d M Y') }}</p>
                                        </div>
                                        @if ($newsItem->is_published)
                                            <span
                                                class="px-2 py-0.5 bg-desa-green text-white text-xs rounded-full">Terbit</span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 bg-yellow-400 text-white text-xs rounded-full">Draft</span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="p-3 text-gray-50 text-sm">Tidak ada berita terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($totalNews > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.news.index') }}"
                                        class="text-desa-skyblue text-sm hover:underline">Lihat Semua Berita &rarr;</a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h5 class="text-lg font-semibold mb-3">Pengajuan Surat Terbaru</h5>
                            <ul class="space-y-3">
                                @forelse($latestServiceRequests as $requestItem)
                                    <li class="p-3 bg-gray-50 rounded-lg flex items-center justify-between">
                                        <div>
                                            <a href="{{ route('admin.service-requests.show', $requestItem) }}"
                                                class="text-dark-text font-medium hover:text-desa-skyblue">{{ Str::limit($requestItem->jenis_surat, 40) }}</a>
                                            <p class="text-xs text-gray-500">{{ $requestItem->nama }} -
                                                {{ $requestItem->created_at->format('d M Y') }}</p>
                                        </div>
                                        @php
                                            $statusClass =
                                                [
                                                    'pending' => 'bg-yellow-500',
                                                    'diproses' => 'bg-blue-500',
                                                    'selesai' => 'bg-desa-green',
                                                    'ditolak' => 'bg-red-500',
                                                ][$requestItem->status] ?? 'bg-gray-500';
                                        @endphp
                                        <span
                                            class="px-2 py-0.5 {{ $statusClass }} text-white text-xs rounded-full">{{ ucfirst($requestItem->status) }}</span>
                                    </li>
                                @empty
                                    <li class="p-3 text-gray-50 text-sm">Tidak ada pengajuan surat terbaru.</li>
                                @endforelse
                            </ul>
                            @if ($pendingServiceRequests > 0)
                                <div class="text-right mt-4">
                                    <a href="{{ route('admin.service-requests.index') }}"
                                        class="text-desa-skyblue text-sm hover:underline">Lihat Semua Pengajuan
                                        &rarr;</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Komentar Pending Terbaru --}}
                    <h5 class="text-lg font-semibold mb-3 mt-8">Komentar Pending Terbaru</h5>
                    <ul class="space-y-3">
                        @forelse($latestComments as $commentItem)
                            <li class="p-3 bg-gray-50 rounded-lg">
                                <div class="flex items-center justify-between mb-1">
                                    <div class="font-medium text-dark-text">
                                        {{ $commentItem->guest_name ?? ($commentItem->user->name ?? 'Anonim') }}</div>
                                    <p class="text-xs text-gray-500">{{ $commentItem->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-700 mb-2">{{ Str::limit($commentItem->content, 100) }}</p>
                                <p class="text-xs text-gray-500">Pada artikel: <a
                                        href="{{ route('news.show', $commentItem->news->slug) }}" target="_blank"
                                        class="text-desa-skyblue hover:underline">{{ Str::limit($commentItem->news->title, 40) }}</a>
                                </p>
                                <div class="text-right mt-2">
                                    <a href="{{ route('admin.comments.index') }}"
                                        class="text-desa-green-600 text-xs hover:underline">Moderasi &rarr;</a>
                                </div>
                            </li>
                        @empty
                            <li class="p-3 text-gray-50 text-sm">Tidak ada komentar pending.</li>
                        @endforelse
                    </ul>
                    @if ($pendingComments > 0)
                        <div class="text-right mt-4">
                            <a href="{{ route('admin.comments.index') }}"
                                class="text-desa-skyblue text-sm hover:underline">Lihat Semua Komentar Pending
                                &rarr;</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
