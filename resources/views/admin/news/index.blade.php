<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- Tambahkan x-data untuk Alpine.js --}}
                <div x-data="{ searchTerm: '' }" class="p-6 text-gray-900">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4"> {{-- Tambahkan gap-4 --}}
                        <a href="{{ route('admin.news.create') }}"
                            class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                            {{-- Sesuaikan lebar tombol --}}
                            Tambah Berita Baru
                        </a>
                        <input type="text" x-model="searchTerm" placeholder="Cari berita..."
                            class="rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50 w-full sm:w-auto">
                        {{-- Sesuaikan lebar input --}}
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="w-full overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Gambar
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Judul
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Penulis
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal Publikasi
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($news as $article)
                                    {{-- Baris ini ditampilkan atau disembunyikan berdasarkan searchTerm --}}
                                    <tr
                                        x-show="articleMatch(JSON.parse('{{ json_encode($article->only(['title', 'author'])) }}'), searchTerm)">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($article->image)
                                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                    class="h-12 w-12 object-cover rounded-md">
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($article->title, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $article->author ?? 'Admin' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($article->is_published)
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-desa-green text-white">
                                                    Terbit
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Draft
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.news.edit', $article) }}"
                                                class="text-desa-skyblue hover:text-blue-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada berita
                                            ditemukan.</td>
                                    </tr>
                                @endforelse
                                {{-- Jika tidak ada hasil setelah filter --}}
                                <tr
                                    x-show="!$el.parentNode.querySelector('tr:not([x-show=\'false\'])') && searchTerm !== ''">
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada hasil
                                        ditemukan untuk pencarian Anda.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Fungsi Alpine.js untuk pencarian client-side
        // Mengambil objek artikel dan string pencarian
        function articleMatch(article, term) {
            // Jika term kosong, tampilkan semua artikel
            if (!term || term.trim() === '') {
                return true;
            }

            // Ubah term menjadi lowercase untuk pencarian non-sensitif huruf besar/kecil
            const lowerCaseTerm = term.toLowerCase();

            // Cek apakah judul atau penulis mengandung term
            return (article.title && article.title.toLowerCase().includes(lowerCaseTerm)) ||
                (article.author && article.author.toLowerCase().includes(lowerCaseTerm));
        }
    </script>
</x-admin-layout>
