<x-admin-layout>
    <div class="p-6 max-w-3xl mx-auto bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Detail Permohonan Surat</h1>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div><span class="font-semibold">Jenis Surat:</span> {{ $surat->jenis_surat }}</div>
            <div><span class="font-semibold">Nama Pemohon:</span> {{ $surat->nama_pemohon }}</div>
            <div><span class="font-semibold">NIK:</span> {{ $surat->nik }}</div>
            <div><span class="font-semibold">Alamat:</span> {{ $surat->alamat }}</div>
            <div><span class="font-semibold">Status:</span>
                <span
                    class="px-2 py-1 rounded text-white text-xs
                    {{ $surat->status == 'diajukan'
                        ? 'bg-yellow-500'
                        : ($surat->status == 'diproses'
                            ? 'bg-blue-500'
                            : ($surat->status == 'disetujui'
                                ? 'bg-green-600'
                                : 'bg-red-600')) }}">
                    {{ ucfirst($surat->status) }}
                </span>
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.surat.cetak', $surat->id) }}" target="_blank"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                🖨 Cetak Surat
            </a>
            <a href="{{ route('admin.surat.index') }}"
                class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 transition">
                ⬅ Kembali
            </a>
        </div>
    </div>
</x-admin-layout>
