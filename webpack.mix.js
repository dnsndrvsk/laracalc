let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


/* Generating windows calculator */
mix.js('resources/assets/reviews/js/app.js', 'public/js/reviews.min.js');
// mix.js('resources/assets/windows_calc/js/app.js', 'public/js/wincalc.js');
