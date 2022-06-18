/** @type {import('tailwindcss').Config} */
const path = require('path');
const colors = require('tailwindcss/colors');

module.exports = {
    content: [
        "./index.html",
        "./src/**/*.{vue,js}",
        "./node_modules/flowbite/**/*.js",
        "./node_modules/litepie-datepicker/**/*.js"
    ],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        // Change with you want it
        'litepie-primary': colors.lightBlue, // color system for light mode
        'litepie-secondary': colors.coolGray // color system for dark mode
      }
    }
  },
  variants: {
    extend: {
      cursor: ['disabled'],
      textOpacity: ['disabled'],
      textColor: ['disabled']
    }
  },
    plugins: [
        require('flowbite/plugin')
    ],
}
