const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

/*_/ mix.combine([
//     'public/css/app.css',
//     'public/vendor/datatables.min.css'
// ], 'public/css/app.css');

// mix.scripts([
//     'public/js/app.js',
//     'public/vendor/datatables.min.js'
// ], 'public/js/app.js');
*/
