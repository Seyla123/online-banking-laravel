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
                battambang: ["Battambang", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                main: {
                    100: '#F8E4E4',
                    200: '#F5C2C2',
                    300: '#F0A3A3',
                    400: '#EC9999',
                    500: '#EA6B6B',
                    600: '#E75555',
                    700: '#E44C4C',
                    800: '#E24040',
                    900: '#E00000',
                    DEFAULT: '#E00000',
                },
            },
        },
    },

    plugins: [forms],
};
