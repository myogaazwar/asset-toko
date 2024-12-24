/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                "main-color": "#b7dbdd",
                "secondary-color": "#73b5b7",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
