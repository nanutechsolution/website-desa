<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $villageName->content ?? config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ Storage::url($siteLogo->content) }}" type="image/png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        :root {
            /* Warna Dasar dari DB (HEX, dihitung di sini ke HSL) */
            @php // Helper function untuk konversi HEX ke HSL di Blade

            $hexToHsl =function($hex) {
                if ( !$hex || !preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $hex)) {
                    return [0,
                    '0%',
                    '0%'];
                }

                $r =hexdec(substr($hex, 1, 2));
                $g =hexdec(substr($hex, 3, 2));
                $b =hexdec(substr($hex, 5, 2));

                $r /=255;
                $g /=255;
                $b /=255;
                $max =max($r, $g, $b);
                $min =min($r, $g, $b);
                $h =$s =$l =($max + $min) / 2;

                if ($max ===$min) {
                    $h =$s =0;
                }

                else {
                    $d =$max - $min;
                    $s =$l >0.5 ? $d / (2 - $max - $min): $d / ($max + $min);

                    switch ($max) {
                        case $r: $h =($g - $b) / $d + ($g < $b ? 6 : 0);
                        break;
                        case $g: $h =($b - $r) / $d + 2;
                        break;
                        case $b: $h =($r - $g) / $d + 4;
                        break;
                    }

                    $h /=6;
                }

                return [round($h * 360),
                round($s * 100) . '%',
                round($l * 100) . '%'];
            }

            ;

            // Dapatkan nilai HEX dari ProfileContent
            $primaryHex =$brandPrimaryColor->content ?? '#4CAF50';
            $secondaryHex =$brandSecondaryColor->content ?? '#2196F3';
            $accentHex =$brandAccentColor->content ?? '#795548';
            $softGrayHex = '#F8F8F8';
            $darkTextHex = '#333333';
            // Konversi ke HSL
            list($h1, $s1, $l1)=$hexToHsl($primaryHex);
            list($h2, $s2, $l2)=$hexToHsl($secondaryHex);
            list($h3, $s3, $l3)=$hexToHsl($accentHex);
            list($h_sg, $s_sg, $l_sg)=$hexToHsl($softGrayHex);
            list($h_dt, $s_dt, $l_dt)=$hexToHsl($darkTextHex);
        @endphp

        --primary-h: {{ $h1 }};
        --primary-s: {{ $s1 }};
        --primary-l: {{ $l1 }};
        --secondary-h: {{ $h2 }};
        --secondary-s: {{ $s2 }};
        --secondary-l: {{ $l2 }};
        --accent-h: {{ $h3 }};
        --accent-s: {{ $s3 }};
        --accent-l: {{ $l3 }};

        /* Varian Warna (Untuk Hover, Background, dll.) */
        --color-primary: hsl(var(--primary-h), var(--primary-s), var(--primary-l));
        --color-primary-dark: hsl(var(--primary-h), var(--primary-s), clamp(0%, calc(var(--primary-l) - 10%), 100%));
        /* Untuk hover/aktif */
        --color-primary-darker: hsl(var(--primary-h), var(--primary-s), calc(var(--primary-l) - 20%));
        /* Untuk bg mobile nav */
        --color-primary-light: hsl(var(--primary-h), var(--primary-s), calc(var(--primary-l) + 10%));
        /* Untuk bg-xx-100 */

        --color-secondary: hsl(var(--secondary-h), var(--secondary-s), var(--secondary-l));
        --color-secondary-dark: hsl(var(--secondary-h), var(--secondary-s), calc(var(--secondary-l) - 10%));
        --color-secondary-light: hsl(var(--secondary-h), var(--secondary-s), calc(var(--secondary-l) + 10%));

        --color-accent: hsl(var(--accent-h), var(--accent-s), var(--accent-l));
        --color-accent-dark: hsl(var(--accent-h), var(--accent-s), calc(var(--accent-l) - 10%));
        /* Warna Netral Dinamis dari HSL Konversi */
        --color-soft-gray: hsl(var(--primary-h), 10%, 95%);
        /* Bisa terkait primary atau statis */
        --color-dark-text: hsl(0, 0%, 20%);
        /* Tetap relatif gelap */
        }
    </style>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="font-sans antialiased overflow-x-hidden">
    <div class="min-h-screen bg-gray-100">
        <x-navbar />
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <main>
            {{ $slot }}
        </main>
    </div>
    <x-footer />
    @livewireStyles
</body>

</html>
