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
        }),
    ],
}