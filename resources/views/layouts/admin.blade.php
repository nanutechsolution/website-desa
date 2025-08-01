<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dasbor Admin') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <aside class="w-64 bg-gray-800 text-white p-4 space-y-4">
            <div class="text-2xl font-bold mb-6">Admin Desa Orakeri</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}"
                    class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">Dashboard</a>
                <a href="{{ route('admin.hero-sliders.index') }}"
                    class="block py-2 px-3 rounded hover:bg-gray-700 {{ request()->routeIs('admin.hero-sliders.*') ? 'bg-gray-700' : '' }}">Hero
                    Slider</a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Manajemen Berita</a>
                <a href="#" class="block py-2 px-3 rounded hover:bg-gray-700">Manajemen Galeri</a>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            {{-- Navigasi Atas Admin (menggunakan navigasi Breeze yang ada) --}}
            {{-- @include('layouts.navigation') --}}

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>
