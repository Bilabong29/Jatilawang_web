import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Menambahkan satu warna utama untuk brand Anda
                'brand': '#047857', // Ini adalah kode hex untuk emerald-700

                // Menambahkan palet warna lengkap dengan nama 'jatilawang'
                'jatilawang': {
                    '500': '#10b981', // emerald-500
                    '600': '#059669', // emerald-600
                    '700': '#047857', // emerald-700
                    '800': '#065f46', // emerald-800
                    '900': '#064e3b', // emerald-900
                    '950': '#022c22', // emerald-950
                }
            }
        },
    },

    plugins: [forms],
};
