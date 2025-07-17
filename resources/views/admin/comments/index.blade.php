<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moderasi Komentar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Hilangkan overflow-hidden supaya scroll nggak terpotong --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Berhasil!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm hidden md:table">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Komentar
                                        Dari</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Isi
                                        Komentar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Artikel
                                        Berita</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                    </th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($comment->is_approved)
                                                <span
                                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-desa-green text-white">Disetujui</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $comment->guest_name ?? ($comment->user->name ?? 'Anonim') }}<br>
                                            <span
                                                class="text-gray-500 text-xs">{{ $comment->guest_email ?? ($comment->user->email ?? '') }}</span>
                                        </td>
                                        <td class="px-6 py-4">{{ Str::limit($comment->content, 100) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ route('news.show', $comment->news->slug) }}" target="_blank"
                                                class="text-desa-skyblue hover:underline">
                                                {{ Str::limit($comment->news->title, 30) }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $comment->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            {{-- Tombol aksi --}}
                                            @if (!$comment->is_approved)
                                                <form action="{{ route('admin.comments.update', $comment) }}"
                                                    method="POST" class="inline-block mr-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="1">
                                                    <button type="submit"
                                                        class="bg-desa-green hover:bg-green-700 text-white py-1 px-2 rounded text-xs">Setujui</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.comments.update', $comment) }}"
                                                    method="POST" class="inline-block mr-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_approved" value="0">
                                                    <button type="submit"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded text-xs">Pendingkan</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.comments.destroy', $comment) }}"
                                                method="POST" class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-xs">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Mobile view pakai card-style --}}
                        <div class="md:hidden space-y-4">
                            @foreach ($comments as $comment)
                                <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
                                    <div class="flex justify-between mb-2">
                                        <div class="text-xs font-semibold text-gray-500">Status:</div>
                                        <div>
                                            @if ($comment->is_approved)
                                                <span
                                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-desa-green text-white">Disetujui</span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-sm font-semibold">
                                        {{ $comment->guest_name ?? ($comment->user->name ?? 'Anonim') }}</div>
                                    <div class="text-xs text-gray-500 mb-2">
                                        {{ $comment->guest_email ?? ($comment->user->email ?? '') }}</div>

                                    <div class="mb-2">
                                        <div class="text-xs font-semibold text-gray-500">Komentar:</div>
                                        <div>{{ Str::limit($comment->content, 100) }}</div>
                                    </div>

                                    <div class="mb-2">
                                        <div class="text-xs font-semibold text-gray-500">Artikel:</div>
                                        <a href="{{ route('news.show', $comment->news->slug) }}"
                                            class="text-desa-skyblue hover:underline text-sm">
                                            {{ Str::limit($comment->news->title, 30) }}
                                        </a>
                                    </div>

                                    <div class="text-xs text-gray-500 mb-2">Tanggal:
                                        {{ $comment->created_at->format('d M Y H:i') }}</div>

                                    <div class="flex gap-2 flex-wrap">
                                        @if (!$comment->is_approved)
                                            <form action="{{ route('admin.comments.update', $comment) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_approved" value="1">
                                                <button type="submit"
                                                    class="bg-desa-green hover:bg-green-700 text-white py-1 px-2 rounded text-xs">Setujui</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.comments.update', $comment) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_approved" value="0">
                                                <button type="submit"
                                                    class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-2 rounded text-xs">Pendingkan</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST"
                                            onsubmit="return confirm('Yakin hapus komentar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded text-xs">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>


                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
