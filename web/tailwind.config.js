/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./index.html",
        "./src/**/*.{vue,js,ts,jsx,tsx}",
    ],
    theme: {
        extend: {},
        colors: {
            geoBlue: '#3B82F6',
            geoGreen: '#22C55E',
            grayBackground: '#efefef',
            white: '#FFFFFF'
        }
    },
    plugins: [],
}
