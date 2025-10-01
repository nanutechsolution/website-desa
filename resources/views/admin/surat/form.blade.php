<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ $surat->exists ? 'Edit Surat' : 'Tambah Surat' }}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-5xl bg-white p-6 rounded shadow mt-6 flex gap-6">
        {{-- Form Input --}}
        <div class="w-1/2">
            <form action="{{ $surat->exists ? route('admin.surat.update', $surat->id) : route('admin.surat.store') }}"
                method="POST" class="space-y-4">
                @csrf
                @if ($surat->exists)
                    @method('PUT')
                @endif

                <input type="text" name="nama_pemohon" placeholder="Nama Pemohon"
                    value="{{ old('nama_pemohon', $surat->nama_pemohon) }}" class="border w-full p-2 rounded" required>
                <input type="text" name="nik" placeholder="NIK" value="{{ old('nik', $surat->nik) }}"
                    class="border w-full p-2 rounded" required>
                <textarea name="alamat" placeholder="Alamat" class="border w-full p-2 rounded" required>{{ old('alamat', $surat->alamat) }}</textarea>
                <textarea name="keperluan" placeholder="Keperluan" class="border w-full p-2 rounded" required>{{ old('keperluan', $surat->keperluan) }}</textarea>

                <select name="jenis_surat_id" id="jenis_surat" class="border w-full p-2 rounded" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    @foreach ($jenisSurat as $jenis)
                        <option value="{{ $jenis->id }}" data-template="{{ htmlspecialchars($jenis->template) }}"
                            {{ $surat->jenis_surat_id == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded w-full">
                    {{ $surat->exists ? 'Update Surat' : 'Tambah Surat' }}
                </button>
            </form>
        </div>

        {{-- Preview Drag & Drop --}}
        <div class="w-1/2 border p-4 rounded h-[600px] overflow-auto" id="preview"
            style="position:relative; background:white;">
            <p class="text-gray-500">Preview akan muncul di sini...</p>
        </div>
    </div>

    {{-- Script Live Preview --}}
    <script>
        const previewDiv = document.getElementById('preview');
        const jenisSelect = document.getElementById('jenis_surat');

        function renderPreview(template) {
            if (!template) return;
            const nama = document.querySelector('input[name="nama_pemohon"]').value;
            const nik = document.querySelector('input[name="nik"]').value;
            const alamat = document.querySelector('textarea[name="alamat"]').value;
            const keperluan = document.querySelector('textarea[name="keperluan"]').value;
            const desa = "{{ $villageName->content ?? '' }}";
            const tanggal = "{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}";
            const kepalaDesa = "{{ $profileKepalaDesa->content ?? '' }}";

            let html = template;

            previewDiv.innerHTML = html;

            // Bikin semua element bisa drag
            previewDiv.querySelectorAll('*').forEach(el => {
                el.setAttribute('draggable', true);
                el.style.position = 'relative';
                el.addEventListener('dragstart', dragStart);
            });
        }

        let dragItem = null;

        function dragStart(e) {
            dragItem = e.target;
        }

        previewDiv.addEventListener('dragover', e => e.preventDefault());
        previewDiv.addEventListener('drop', e => {
            e.preventDefault();
            if (!dragItem) return;
            dragItem.style.position = 'absolute';
            dragItem.style.left = (e.offsetX - dragItem.offsetWidth / 2) + 'px';
            dragItem.style.top = (e.offsetY - dragItem.offsetHeight / 2) + 'px';
            dragItem = null;
        });

        // update preview saat input berubah
        document.querySelectorAll('input, textarea, select').forEach(el => {
            el.addEventListener('input', () => {
                const template = jenisSelect.selectedOptions[0]?.dataset.template;
                renderPreview(template);
            });
        });

        // render awal jika edit mode
        window.addEventListener('load', () => {
            const template = jenisSelect.selectedOptions[0]?.dataset.template;
            renderPreview(template);
        });
    </script>
</x-admin-layout>
