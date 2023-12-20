/** @type {import('tailwindcss').Config} */
import forms from '@tailwindcss/forms';

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ], theme: {
        extend: {
            gridTemplateRows: {
                'layout': "auto 1fr auto",
            },
            fontFamily: {
                main: ['Montserrat'],
            },
        },
    },
    plugins: [forms],
}

