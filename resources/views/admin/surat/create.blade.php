<x-admin-layout>
    <div class="p-6 max-w-lg mx-auto bg-white shadow rounded-lg">
        <h1 class="text-xl font-bold mb-4">Buat Permohonan Surat</h1>

        <form action="{{ route('admin.surat.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Jenis Surat</label>
                <select name="jenis_surat" class="w-full border-gray-300 rounded-lg" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                    <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                    <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                </select>
                @error('jenis_surat')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Nama Pemohon</label>
                <input type="text" name="nama_pemohon" value="{{ old('nama_pemohon') }}"
                    class="w-full border-gray-300 rounded-lg" required>
                @error('nama_pemohon')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">NIK</label>
                <input type="text" name="nik" value="{{ old('nik') }}"
                    class="w-full border-gray-300 rounded-lg" required>
                @error('nik')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Alamat</label>
                <textarea name="alamat" class="w-full border-gray-300 rounded-lg" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex justify-end">
                <a href="{{ route('admin.surat.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded-lg mr-2 hover:bg-gray-400">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>
