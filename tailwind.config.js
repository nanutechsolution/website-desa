import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // Pastikan baris ini ada dan benar
    ],


    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Palet Hijau Keren
                'desa-green': { // Anda bisa mendefinisikan skala warna
                    DEFAULT: '#4CAF50', // Hijau primer
                    '50': '#E8F5E9',
                    '100': '#D4EAD6',
                    '200': '#A5D6A7',
                    '300': '#81C784',
                    '400': '#66BB6A', // Hijau sedikit lebih terang
                    '500': '#4CAF50', // Sama dengan DEFAULT
                    '600': '#43A047', // Hijau sedikit lebih gelap
                    '700': '#388E3C', // Hijau lebih gelap untuk hover/aksen
                    '800': '#2E7D32',
                    '900': '#1B5E20',
                },
                'desa-brown': '#795548',
                'desa-skyblue': '#2196F3',
                'vibrant-green': '#00C853', // Hijau yang lebih cerah/bersemangat sebagai aksen kuat
                'soft-gray': '#F8F8F8', // Abu-abu terang untuk latar belakang
                'dark-text': '#333333', // Warna teks gelap yang lebih kaya dari gray-900'

            },
        },
    },

    plugins: [
        forms,
        //  require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),],
};
