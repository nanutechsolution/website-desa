<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Permohonan Surat Rekomendasi Kelakuan Baik') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="nama" class="block text-gray-700 font-medium">Nama Lengkap</label>
                        <input type="text" name="nama" id="nama"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 font-medium">NIK</label>
                        <input type="text" name="nik" id="nik"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- TTL -->
                    <div class="mb-4">
                        <label for="ttl" class="block text-gray-700 font-medium">Tempat / Tanggal Lahir</label>
                        <input type="text" name="ttl" id="ttl"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-4">
                        <label for="jk" class="block text-gray-700 font-medium">Jenis Kelamin</label>
                        <select name="jk" id="jk"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Agama -->
                    <div class="mb-4">
                        <label for="agama" class="block text-gray-700 font-medium">Agama</label>
                        <input type="text" name="agama" id="agama"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <!-- Pekerjaan -->
                    <div class="mb-4">
                        <label for="pekerjaan" class="block text-gray-700 font-medium">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="block text-gray-700 font-medium">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            required></textarea>
                    </div>

                    <!-- Upload KTP -->
                    <div class="mb-4">
                        <label for="ktp" class="block text-gray-700 font-medium">Upload KTP</label>
                        <input type="file" name="ktp" id="ktp" class="mt-1 block w-full"
                            accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>

                    <!-- Upload KK -->
                    <div class="mb-4">
                        <label for="kk" class="block text-gray-700 font-medium">Upload KK</label>
                        <input type="file" name="kk" id="kk" class="mt-1 block w-full"
                            accept=".jpg,.jpeg,.png,.pdf" required>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Kirim Permohonan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
