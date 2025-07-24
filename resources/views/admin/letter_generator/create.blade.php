<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generator Surat Desa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-semibold mb-6">Pilih Jenis Surat & Isi Detail</h3>

                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                            role="alert">
                            <strong class="font-bold">Ada Kesalahan Validasi!</strong>
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.letter-generator.generate') }}" method="POST"
                        x-data="{ selectedLetterType: '{{ old('letter_type') }}' }">
                        @csrf

                        {{-- Pilih Jenis Surat --}}
                        <div class="mb-4">
                            <label for="letter_type" class="block text-sm font-medium text-gray-700">Jenis Surat</label>
                            <select id="letter_type" name="letter_type" x-model="selectedLetterType"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                required>
                                <option value="">-- Pilih Jenis Surat --</option>
                                @foreach ($letterTypes as $key => $name)
                                    <option value="{{ $key }}"
                                        {{ old('letter_type') == $key ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('letter_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Input Umum untuk Semua Surat --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="nomor_surat" class="block text-sm font-medium text-gray-700">Nomor
                                    Surat</label>
                                <input type="text" name="nomor_surat" id="nomor_surat"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                    value="{{ old('nomor_surat', '470/D-' . (old('letter_type') ? $letterTypes[old('letter_type')] : '') . '/' . date('Y')) }}"
                                    required>
                                {{-- atau lebih sederhana lagi: value="{{ old('nomor_surat', '470/D-/'.date('Y')) }}" --}}
                                {{-- atau paling sederhana: value="{{ old('nomor_surat') }}" --}}
                                @error('nomor_surat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tanggal_surat" class="block text-sm font-medium text-gray-700">Tanggal
                                    Surat</label>
                                <input type="date" name="tanggal_surat" id="tanggal_surat"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                    value="{{ old('tanggal_surat', date('Y-m-d')) }}" required>
                                @error('tanggal_surat')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Form Khusus Berdasarkan Jenis Surat --}}
                        <div class="border-t pt-6 mt-6">
                            {{-- Surat Keterangan Kepemilikan Hewan --}}
                            <template x-if="selectedLetterType === 'ownership_certificate'">
                                <div>
                                    <h4 class="text-lg font-semibold mb-4 text-desa-green">Detail Kepemilikan Hewan</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="nama_pemilik"
                                                class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                                            <input type="text" name="nama_pemilik" id="nama_pemilik"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('nama_pemilik') }}">
                                            @error('nama_pemilik')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="nik_pemilik" class="block text-sm font-medium text-gray-700">NIK
                                                Pemilik</label>
                                            <input type="text" name="nik_pemilik" id="nik_pemilik"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('nik_pemilik') }}">
                                            @error('nik_pemilik')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="alamat_pemilik"
                                                class="block text-sm font-medium text-gray-700">Alamat Pemilik</label>
                                            <textarea name="alamat_pemilik" id="alamat_pemilik" rows="2"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('alamat_pemilik') }}</textarea>
                                            @error('alamat_pemilik')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="jenis_hewan"
                                                class="block text-sm font-medium text-gray-700">Jenis Hewan</label>
                                            <input type="text" name="jenis_hewan" id="jenis_hewan"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('jenis_hewan') }}">
                                            @error('jenis_hewan')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="jumlah_hewan"
                                                class="block text-sm font-medium text-gray-700">Jumlah Hewan</label>
                                            <input type="number" name="jumlah_hewan" id="jumlah_hewan" min="1"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('jumlah_hewan', 1) }}">
                                            @error('jumlah_hewan')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="ciri_hewan"
                                                class="block text-sm font-medium text-gray-700">Ciri-ciri Hewan (Warna,
                                                Ukuran, Tanda Khusus)</label>
                                            <textarea name="ciri_hewan" id="ciri_hewan" rows="3"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('ciri_hewan') }}</textarea>
                                            @error('ciri_hewan')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="catatan_tambahan"
                                                class="block text-sm font-medium text-gray-700">Catatan Tambahan
                                                (Opsional)</label>
                                            <textarea name="catatan_tambahan" id="catatan_tambahan" rows="2"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('catatan_tambahan') }}</textarea>
                                            @error('catatan_tambahan')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </template>
                            {{-- Surat Keterangan Domisili --}}
                            <template x-if="selectedLetterType === 'domicile_certificate'">
                                <div>
                                    <h4 class="text-lg font-semibold mb-4 text-desa-green">Detail Domisili</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="nama_penduduk"
                                                class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                            <input type="text" name="nama_penduduk" id="nama_penduduk"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('nama_penduduk') }}">
                                            @error('nama_penduduk')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="nik_penduduk"
                                                class="block text-sm font-medium text-gray-700">NIK</label>
                                            <input type="text" name="nik_penduduk" id="nik_penduduk"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('nik_penduduk') }}">
                                            @error('nik_penduduk')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="tempat_lahir"
                                                class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('tempat_lahir') }}">
                                            @error('tempat_lahir')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="tanggal_lahir"
                                                class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="jenis_kelamin"
                                                class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                            <select id="jenis_kelamin" name="jenis_kelamin"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">
                                                <option value="">Pilih</option>
                                                <option value="Laki-laki"
                                                    {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="Perempuan"
                                                    {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="agama"
                                                class="block text-sm font-medium text-gray-700">Agama</label>
                                            <input type="text" name="agama" id="agama"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('agama') }}">
                                            @error('agama')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="pekerjaan"
                                                class="block text-sm font-medium text-gray-700">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" id="pekerjaan"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50"
                                                value="{{ old('pekerjaan') }}">
                                            @error('pekerjaan')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="alamat_sebelumnya"
                                                class="block text-sm font-medium text-gray-700">Alamat Sebelumnya
                                                (Opsional)</label>
                                            <textarea name="alamat_sebelumnya" id="alamat_sebelumnya" rows="2"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('alamat_sebelumnya') }}</textarea>
                                            @error('alamat_sebelumnya')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="alamat_sekarang"
                                                class="block text-sm font-medium text-gray-700">Alamat Sekarang</label>
                                            <textarea name="alamat_sekarang" id="alamat_sekarang" rows="2"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('alamat_sekarang') }}</textarea>
                                            @error('alamat_sekarang')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="md:col-span-2">
                                            <label for="keperluan_domisili"
                                                class="block text-sm font-medium text-gray-700">Keperluan</label>
                                            <textarea name="keperluan_domisili" id="keperluan_domisili" rows="2"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-desa-skyblue focus:ring focus:ring-desa-skyblue focus:ring-opacity-50">{{ old('keperluan_domisili') }}</textarea>
                                            @error('keperluan_domisili')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-desa-green border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Pratinjau Surat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
