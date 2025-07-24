<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Pengaturan Warna Tema</h2>
    </x-slot>

    <form method="POST" action="{{ route('admin.theme.update') }}" class="space-y-6 mt-6">
        @csrf

        <label for=""></label>
        <input type="text" name="brand_primary_color_hsl" value="{{ old('brand_primary_color_hsl', $primary) }}"
            class="input" />

        <input type="text" name="brand_secondary_color_hsl"
            value="{{ old('brand_secondary_color_hsl', $secondary) }}" class="input" />

        <input type="text" name="brand_accent_color_hsl" value="{{ old('brand_accent_color_hsl', $accent) }}"
            class="input" />

        <button class="text-white px-4 py-2 rounded" style="background-color: var(--color-primary)">
            Simpan
        </button>

        <button class="brand-primary text-white hover:bg-primary/80">Tombol Desa</button>
        <div class="brand-secondary text-white p-4">Sekunder</div>
        <span class="text-accent">Teks Accent</span>

    </form>
</x-app-layout>
