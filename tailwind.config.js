import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const plugin = require('tailwindcss/plugin')
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
                'vibrant-green': '#00C853',
                'soft-gray': '#F8F8F8',
                'dark-text': '#333333',
                primary: 'hsl(var(--primary-h), var(--primary-s), var(--primary-l))',
                'primary-dark': 'hsl(var(--primary-h), var(--primary-s), calc(var(--primary-l) - 10%))',
                'primary-darker': 'hsl(var(--primary-h), var(--primary-s), calc(var(--primary-l) - 20%))',
                'primary-light': 'hsl(var(--primary-h), var(--primary-s), calc(var(--primary-l) + 10%))',
                secondary: 'hsl(var(--secondary-h), var(--secondary-s), var(--secondary-l))',
                'secondary-dark': 'hsl(var(--secondary-h), var(--secondary-s), calc(var(--secondary-l) - 10%))',
                'secondary-light': 'hsl(var(--secondary-h), var(--secondary-s), calc(var(--secondary-l) + 10%))',
                accent: 'hsl(var(--accent-h), var(--accent-s), var(--accent-l))',
                'accent-dark': 'hsl(var(--accent-h), var(--accent-s), calc(var(--accent-l) - 10%))',
                'soft-gray': 'hsl(var(--primary-h), 10%, 95%)',
                'dark-text': 'hsl(0, 0%, 20%)',

            },
        },
    },

    plugins: [
        forms,
        //  require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/typography'),

        plugin(function ({ addBase }) {
            addBase({
                ':root': {
                    '--primary-h': '220',
                    '--primary-s': '90%',
                    '--primary-l': '55%',
                    '--secondary-h': '160',
                    '--secondary-s': '60%',
                    '--secondary-l': '45%',
                    '--accent-h': '45',
                    '--accent-s': '100%',
                    '--accent-l': '50%',
                },
            });
        }),],
};
