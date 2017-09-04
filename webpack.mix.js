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

mix.sass('resources/assets/sass/app.scss', 'public/css')
   .copy('resources/assets/images/*', 'public/images')
   .copy('node_modules/font-awesome/fonts/*', 'public/fonts')
   .scripts([
       'node_modules/jquery/dist/jquery.min.js',
       'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ], 'public/js/app.js')
   .combine([
        'node_modules/font-awesome/css/font-awesome.min.css'
    ], 'public/css/styles.css');
