import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'black' : '#0C1618',
                'white' : '#FAF9F6',
                'cool-gray' : '#7D84B2',
                'brunswick-green' : '#004643',
                'mindaro' : '#DBF4A7',
                'cerise' : '#e2577d',
            },
        },
    },
    plugins: [],
};
