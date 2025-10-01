<x-app-layout>
    <div class="max-w-xl mx-auto bg-white p-6 shadow rounded text-center">
        <h1 class="text-xl font-bold mb-4 text-green-600">Permohonan Berhasil!</h1>
        <p class="mb-2">Terima kasih sudah mengajukan permohonan surat.</p>
        <p class="mb-2">Kode Tracking Anda:</p>
        <h2 class="text-2xl font-mono bg-gray-100 p-2 rounded">{{ $surat->kode_tracking }}</h2>
        <p class="mt-4">Gunakan kode ini untuk mengecek status surat Anda.</p>

        <a href="/" class="mt-6 inline-block bg-blue-500 text-white px-4 py-2 rounded">
            Kembali ke Beranda
        </a>
    </div>
</x-app-layout>
