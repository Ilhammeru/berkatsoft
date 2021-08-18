const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/navigate.js', 'public/assets/js')
    .js('resources/js/jquery.js', 'public/js')
    .js('resources/assets/js/login.js', 'public/assets/js')
    .js('resources/assets/js/customer.js', 'public/assets/js')
    .js('resources/assets/js/product.js', 'public/assets/js')
    .js('resources/assets/js/sales.js', 'public/assets/js')
    .js('resources/assets/js/pagination.js', 'public/assets/js')
    .js('resources/js/sweetalert.js', 'public/js')
    .postCss('resources/css/login.css', 'public/assets/css')
    .postCss('resources/css/master.css', 'public/assets/css')
    .postCss('resources/css/app.css', 'public/css', [
    ]);
