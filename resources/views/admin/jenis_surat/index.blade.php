<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Manajemen Jenis Surat') }}
        </h2>
    </x-slot>

    <div class="container mx-auto">
        <a href="{{ route('admin.jenis-surat.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded mb-3 inline-block">
            + Tambah Jenis Surat
        </a>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">#</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Kode</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenis as $j)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $j->nama }}</td>
                        <td class="border px-4 py-2">{{ $j->kode }}</td>
                        <td class="border px-4 py-2">{{ $j->deskripsi }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('admin.jenis-surat.preview', $j->id) }}"
                                class="bg-green-600 text-white px-2 py-1 rounded">Preview</a>

                            <a href="{{ route('admin.jenis-surat.edit', $j->id) }}"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</a>

                            <form action="{{ route('admin.jenis-surat.destroy', $j->id) }}" method="POST"
                                class="inline" onsubmit="return confirm('Yakin mau hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-2 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center p-4">Belum ada jenis surat</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $jenis->links() }}
        </div>
    </div>
</x-admin-layout>
