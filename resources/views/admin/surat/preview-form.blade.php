<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Isi Data untuk Preview {{ $jenis->nama }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <form action="{{ route('admin.jenis-surat.preview.show', $jenis->id) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Nama</label>
                <input type="text" name="nama" class="border w-full p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">NIK</label>
                <input type="text" name="nik" class="border w-full p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Alamat</label>
                <textarea name="alamat" class="border w-full p-2 rounded" required></textarea>
            </div>

            <div>
                <label class="block font-medium">Desa</label>
                <input type="text" name="desa" class="border w-full p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Tanggal</label>
                <input type="date" name="tanggal" class="border w-full p-2 rounded" value="{{ date('Y-m-d') }}"
                    required>
            </div>

            <div>
                <label class="block font-medium">Kepala Desa</label>
                <input type="text" name="kepala_desa" class="border w-full p-2 rounded" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Lihat Preview
            </button>
        </form>
    </div>
</x-admin-layout>
