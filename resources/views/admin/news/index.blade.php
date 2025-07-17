<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="">
            <div class="">
                <div x-data="{ searchTerm: '' }" class="p-4 sm:p-6 text-gray-900">
                    {{-- Tombol Tambah dan Input Cari --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                        <a href="{{ route('admin.news.create') }}"
                            class="bg-desa-skyblue hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto text-center">
                            Tambah Berita Baru
                        </a>
                        <input type="text" x-model="searchTerm" placeholder="Cari berita..."
                            class="rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50 w-full sm:w-auto">
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Table Responsive --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Gambar</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Judul</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Penulis</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Tanggal</th>
                                    <th class="px-4 py-2 text-left font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-2 text-right font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($news as $article)
                                    <tr
                                        x-show="articleMatch(JSON.parse('{{ json_encode($article->only(['title', 'author'])) }}'), searchTerm)">
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if ($article->image)
                                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                    class="h-12 w-12 object-cover rounded-md">
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">{{ Str::limit($article->title, 10) }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ Str::limit($article->author, 10) ?? 'Admin' }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if ($article->is_published)
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold bg-desa-green text-white rounded-full">Terbit</span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Draft</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.news.edit', $article) }}"
                                                class="text-desa-skyblue hover:text-blue-900 mr-3">Edit</a>
                                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                                class="inline"
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
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada berita
                                            ditemukan.</td>
                                    </tr>
                                @endforelse
                                <tr
                                    x-show="!$el.parentNode.querySelector('tr:not([x-show=\'false\'])') && searchTerm !== ''">
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500">Tidak ada hasil
                                        ditemukan untuk pencarian Anda.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $news->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AlpineJS Function --}}
    <script>
        function articleMatch(article, term) {
            if (!term || term.trim() === '') {
                return true;
            }
            const lowerCaseTerm = term.toLowerCase();
            return (article.title && article.title.toLowerCase().includes(lowerCaseTerm)) ||
                (article.author && article.author.toLowerCase().includes(lowerCaseTerm));
        }
    </script>
</x-admin-layout>
