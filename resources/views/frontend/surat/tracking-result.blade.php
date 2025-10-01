<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Hasil Pencarian Surat</h1>
        @if ($surat)
            <div class="mb-4">
                <p><strong>Kode Tracking:</strong> {{ $surat->kode_tracking }}</p>
                <p><strong>Nama Pemohon:</strong> {{ $surat->nama_pemohon }}</p>
                <p><strong>NIK:</strong> {{ $surat->nik }}</p>
                <p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
                <p><strong>Alamat:</strong> {{ $surat->alamat }}</p>
                <p>
                    <strong>Status:</strong>
                    @if ($surat->status == 'diajukan')
                        <span class="text-yellow-600">Diajukan</span>
                    @elseif($surat->status == 'diproses')
                        <span class="text-blue-600">Diproses</span>
                    @elseif($surat->status == 'disetujui')
                        <span class="text-green-600">Disetujui</span>
                        <br>
                        <a href="{{ route('admin.surat.cetak', $surat->id) }}"
                            class="text-white bg-green-600 px-3 py-1 rounded inline-block mt-2">
                            Download Surat
                        </a>
                    @else
                        <span class="text-red-600">Ditolak</span>
                    @endif
                </p>
            </div>
        @else
            <div class="bg-red-100 text-red-700 p-3 rounded">
                Surat dengan kode tracking tersebut tidak ditemukan.
            </div>
        @endif
    </div>
</x-app-layout>
