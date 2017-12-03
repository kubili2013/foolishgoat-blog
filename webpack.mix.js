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

// mix.js('resources/assets/js/core/jquery.3.2.1.min.js', 'public/js/jquery.3.2.1.min.js');
// mix.js('resources/assets/js/core/popper.min.js', 'public/js/popper.min.js');
// mix.js('resources/assets/js/core/bootstrap.min.js', 'public/js/bootstrap.min.js');
// mix.copy('resources/assets/js/plugins/sweetalert.min.js','public/js/sweetalert.min.js');
// mix.copy('resources/assets/css/sweetalert.css','public/css/sweetalert.css');
mix.scripts([
    'resources/assets/js/plugins/bootstrap-datepicker.js',
    'resources/assets/js/plugins/bootstrap-switch.js',
    'resources/assets/js/plugins/jquery.sharrre.js',
    'resources/assets/js/plugins/nouislider.min.js',
        'resources/assets/js/plugins/moment.min.js',
    // 'resources/assets/js/plugins/bootstrap-tagsinput.min.js'
    ],
    'public/js/plugin.js');

mix.scripts(['resources/assets/js/now-ui-kit.js','resources/assets/js/logo.js'], 'public/js/app.js').version();
mix.scripts(['resources/assets/js/menu.js'], 'public/js/mine.js').version();




mix.styles(['resources/assets/css/logo.css','resources/assets/css/demo.css','resources/assets/css/menu.css','resources/assets/css/mylove.css'], 'public/css/app.css').version();
