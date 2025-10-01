<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-xl font-bold mb-4">Cek Status Surat</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('surat.tracking.result') }}">
            @csrf
            <div class="mb-3">
                <label class="block">Masukkan Kode Tracking</label>
                <input type="text" name="kode_tracking" class="w-full border rounded p-2"
                    placeholder="contoh: SR-20250915-1234">
                @error('kode_tracking')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Cek</button>
        </form>
    </div>
</x-app-layout>
