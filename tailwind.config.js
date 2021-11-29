const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            boxShadow: {
                left: '-20px 0 80px rgba(0, 0, 0, 0.1)'
            },

            colors: {
                gray: colors.trueGray
            },
        },

        fontFamily: {
            sans: ['Poppins', ...defaultTheme.fontFamily.sans]
        }
    },
    variants: {
        extend: {},
    },
    plugins: [],
}
