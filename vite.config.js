import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'public/assets/css/bootstrap.min.css',
                'public/assets/plugins/fontawesome/css/fontawesome.min.css',
                'public/assets/plugins/fontawesome/css/all.min.css',
                'public/assets/css/feather.css',
                'public/assets/css/bootstrap-datetimepicker.min.css',
                'public/assets/plugins/datatables/datatables.min.css',                
                'public/assets/css/animate.css',
                'public/assets/css/style.css',

                'resources/js/app.js',
                'public/assets/js/jquery-3.6.0.min.js',
                'public/assets/js/bootstrap.bundle.min.js',
                'public/assets/js/feather.min.js',
                'public/assets/plugins/slimscroll/jquery.slimscroll.min.js',
                'public/assets/plugins/select2/js/select2.min.js',
                'public/assets/plugins/moment/moment.min.js',
                'public/assets/js/bootstrap-datetimepicker.min.js',
                'public/assets/plugins/datatables/jquery.dataTables.min.js',
                'public/assets/plugins/datatables/datatables.min.js',
                'public/assets/js/script.js',

            ],
            refresh: true,
        }),
    ],
});
