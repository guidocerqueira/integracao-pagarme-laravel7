const mix = require('laravel-mix');

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

mix
    .styles([
        'resources/views/admin/assets/plugins/fontawesome-free/css/all.min.css',
        'resources/views/admin/assets/plugins/ionicons/ionicons.min.css',
        'resources/views/admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'resources/views/admin/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'resources/views/admin/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'resources/views/admin/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css',
        'resources/views/admin/assets/dist/css/adminlte.min.css',
        'resources/views/admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css'
    ], 'public/dash/assets/css/app.css')

    .scripts([
        'resources/views/admin/assets/plugins/jquery/jquery.min.js',
        'resources/views/admin/assets/plugins/jquery-ui/jquery-ui.min.js',
        'resources/views/admin/assets/dist/js/conflict.js',
        'resources/views/admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
        'resources/views/admin/assets/plugins/sweetalert2/sweetalert2.all.min.js',
        'resources/views/admin/assets/plugins/datatables/jquery.dataTables.min.js',
        'resources/views/admin/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'resources/views/admin/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js',
        'resources/views/admin/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
        'resources/views/admin/assets/plugins/moment/moment.min.js',
        'resources/views/admin/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'resources/views/admin/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'resources/views/admin/assets/plugins/inputmask2/inputmask.js',
        'resources/views/admin/assets/plugins/inputmask2/init-inputmask.js',
        'resources/views/admin/assets/dist/js/adminlte.js',
        'resources/views/admin/assets/dist/js/scripts.js',
    ], 'public/dash/assets/js/app.js')

    .styles([
        'resources/views/site/assets/css/bootstrap.css',
        'resources/views/site/assets/js/datatable/datatable.css',
    ], 'public/site/assets/css/app.css')

    .scripts([
        'resources/views/site/assets/js/jquery.js',
        'resources/views/site/assets/js/popper.js',
        'resources/views/site/assets/js/bootstrap.js',
        'resources/views/site/assets/js/datatable/jquery.datatable.js',
        'resources/views/site/assets/js/datatable/bootstrap.datatable.js',
        'resources/views/site/assets/js/inputmask2/inputmask.js',
        'resources/views/site/assets/js/inputmask2/init-inputmask.js',
    ], 'public/site/assets/js/app.js')

    .copyDirectory('resources/views/admin/assets/plugins/fontawesome-free/webfonts', 'public/dash/assets/webfonts')

    .options({
        processCssUrls: false
    })

    .version()
;
