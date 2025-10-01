<x-admin-layout>
    <x-slot name="header">
        <h2>{{ $jenis->exists ? 'Edit Jenis Surat' : 'Tambah Jenis Surat' }}</h2>
    </x-slot>

    <div class="container mx-auto mt-4">
        <form
            action="{{ $jenis->exists ? route('admin.jenis-surat.update', $jenis->id) : route('admin.jenis-surat.store') }}"
            method="POST" class="space-y-4">
            @csrf
            @if ($jenis->exists)
                @method('PUT')
            @endif

            <div>
                <label class="block font-medium">Nama Jenis Surat</label>
                <input type="text" name="nama" value="{{ old('nama', $jenis->nama) }}"
                    class="border w-full p-2 rounded" required>
            </div>

            <div>
                <label class="block font-medium">Kode Surat</label>
                <input type="text" name="kode" value="{{ old('kode', $jenis->kode) }}"
                    class="border w-full p-2 rounded">
            </div>

            <div>
                <label class="block font-medium">Deskripsi</label>
                <textarea name="deskripsi" class="border w-full p-2 rounded">{{ old('deskripsi', $jenis->deskripsi) }}</textarea>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('admin.jenis-surat.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded">{{ $jenis->exists ? 'Update' : 'Simpan' }}</button>
            </div>
        </form>
    </div>
</x-admin-layout>
