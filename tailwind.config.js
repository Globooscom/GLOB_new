const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        screens: {
            'exl': {'max': '1920px'},
            'xxl': {'max': '1572px'},
            'xl': {'max': '1366px'},
            'x': {'max': '1180px'},
            'lg': {'max': '992px'},
            'md': {'max': '766px'},
            'sm': {'max': '576px'}
        },
        extend: {},
    },

    plugins: [require('@tailwindcss/forms')],
};
