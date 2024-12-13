const mix = require('laravel-mix');
const vue = require('vue-loader');

mix.js('resources/js/app.js', 'public/js')
   .vue() // Pastikan ini ada untuk memproses file Vue
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ])
   .version();
