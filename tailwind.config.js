/** @type {import('tailwindcss').Config} */
export default {
    presets: [
            require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],
    theme: {
        extend: {},
    },
    corePlugins: {
        aspectRatio: false,
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/aspect-ratio'),
    ],
}

