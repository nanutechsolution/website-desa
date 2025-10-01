<x-admin-layout>
    <div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Daftar Surat</h1>
            <a href="{{ route('admin.surat.create') }}"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Tambah Surat
            </a>
        </div>

        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Jenis</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surats as $s)
                    <tr>
                        <td class="px-4 py-2 border">{{ $s->kode_tracking }}</td>
                        <td class="px-4 py-2 border">{{ $s->nama_pemohon }}</td>
                        <td class="px-4 py-2 border">{{ $s->jenis->nama }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($s->status) }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            {{-- <a href="{{ route('admin.surat.edit', $s->id) }}"
                                class="bg-indigo-600 text-white px-3 py-1 rounded">Edit</a> --}}

                            @if ($s->status == 'diajukan')
                                <form action="{{ route('admin.surat.update', $s->id) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="diproses">
                                    <button type="submit"
                                        class="bg-blue-600 text-white px-3 py-1 rounded">Proses</button>
                                </form>
                            @elseif($s->status == 'diproses')
                                <form action="{{ route('admin.surat.update', $s->id) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="disetujui">
                                    <button type="submit"
                                        class="bg-green-600 text-white px-3 py-1 rounded">Setujui</button>
                                </form>
                                <form action="{{ route('admin.surat.update', $s->id) }}" method="POST" class="inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="ditolak">
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded">Tolak</button>
                                </form>
                            @elseif ($s->status == 'disetujui')
                                <a href="{{ route('admin.surat.preview', $s->id) }}"
                                    class="bg-yellow-500 text-white px-3 py-1 rounded">Preview</a>

                                <a href="{{ route('admin.surat.cetak', $s->id) }}"
                                    class="bg-gray-700 text-white px-3 py-1 rounded">Cetak</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-admin-layout>
