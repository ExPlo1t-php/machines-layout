const defaultTheme = require('tailwindcss/defaultTheme');


/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        fontSize: {
            '2xs': '.55rem',
            '3xs': '.45rem',
            '4xs': '.35rem',
          }
        
    },
    
    plugins:[
        require('@tailwindcss/forms'),
        require('flowbite/plugin')
    ],

};
