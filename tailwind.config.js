/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./app/filament/**/*.php",
        "./vendor/awcodes/filament-quick-create/resources/**/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
