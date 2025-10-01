<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Ajukan Permohonan Surat</h2>
    <form action="{{ route('surat.public.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="jenis_surat_id" class="block">Jenis Surat</label>
            <select name="jenis_surat_id" id="jenis_surat_id" class="w-full border rounded p-2">
                @foreach ($jenis as $j)
                    <option value="{{ $j->id }}">{{ $j->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Nama Pemohon</label>
            <input type="text" name="nama_pemohon" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block">NIK</label>
            <input type="text" name="nik" class="w-full border rounded p-2" required>
        </div>

        <div>
            <label class="block">Alamat</label>
            <textarea name="alamat" class="w-full border rounded p-2" required></textarea>
        </div>

        <div>
            <label class="block">Keperluan</label>
            <input type="text" name="keperluan" class="w-full border rounded p-2"
                placeholder="Misal: Melamar pekerjaan" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Ajukan
        </button>
    </form>
</x-app-layout>
