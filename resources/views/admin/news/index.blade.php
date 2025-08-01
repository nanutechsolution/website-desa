<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Berita') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="">
            <div class="">
                <div x-data="{ searchTerm: '' }" class="p-4 sm:p-6 text-gray-900 dark:text-gray-100">

                    {{-- Tombol Tambah dan Input Cari --}}
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
                        <a href="{{ route('admin.news.create') }}"
                            class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 w-full sm:w-auto">
                            Tambah Berita Baru
                        </a>
                        <input type="text" x-model="searchTerm" placeholder="Cari berita..."
                            class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50 w-full sm:w-auto">
                    </div>

                    {{-- Flash Message --}}
                    @if (session('success'))
                        <div class="bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Table Responsive --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Gambar</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Judul</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Penulis</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Tanggal</th>
                                    <th
                                        class="px-4 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Status</th>
                                    <th
                                        class="px-4 py-2 text-right font-medium text-gray-500 dark:text-gray-300 uppercase">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($news as $article)
                                    <tr
                                        x-show="articleMatch(JSON.parse('{{ json_encode($article->only(['title', 'author'])) }}'), searchTerm)">
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if ($article->image)
                                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                                                    class="h-12 w-12 object-cover rounded-md">
                                            @else
                                                <span class="text-gray-400 dark:text-gray-600">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ Str::limit($article->title, 10) }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ Str::limit($article->author, 10) ?? 'Admin' }}</td>
                                        <td class="px-4 py-2 whitespace-nowrap text-gray-800 dark:text-gray-100">
                                            {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap">
                                            @if ($article->is_published)
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold bg-desa-green text-white rounded-full">Terbit</span>
                                            @else
                                                <span
                                                    class="inline-flex px-2 text-xs font-semibold bg-yellow-100 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 rounded-full">Draft</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 whitespace-nowrap text-right">
                                            <a href="{{ route('admin.news.edit', $article) }}"
                                                class="text-desa-skyblue hover:text-blue-900 dark:hover:text-blue-300 mr-3">Edit</a>
                                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"
                                            class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">Tidak ada
                                            berita ditemukan.</td>
                                    </tr>
                                @endforelse
                                <tr
                                    x-show="!$el.parentNode.querySelector('tr:not([x-show=\'false\'])') && searchTerm !== ''">
                                    <td colspan="6" class="px-4 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Tidak ada hasil
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
