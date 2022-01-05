const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    darkMode: 'class',
    theme: {
        extend: {
            boxShadow: {
                left: '-20px 0 80px rgba(0, 0, 0, 0.1)'
            },

            colors: {
                gray: colors.neutral
            },
        },

        fontFamily: {
            sans: ['Poppins', ...defaultTheme.fontFamily.sans]
        }
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms')
    ],
}
