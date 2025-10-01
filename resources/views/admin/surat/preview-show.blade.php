<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            Preview Surat: {{ $jenis->nama }}
        </h2>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
        <div class="prose max-w-none">
            {!! nl2br(e($content)) !!}
        </div>

        <div class="mt-6">
            <a href="{{ route('admin.jenis-surat.preview', $jenis->id) }}"
                class="bg-gray-500 text-white px-4 py-2 rounded">Ubah Data</a>
        </div>
    </div>
</x-admin-layout>
