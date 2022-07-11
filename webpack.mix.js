const mix = require('laravel-mix');
const webpack = require('webpack');
const path = require('path');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

mix.options({
    processCssUrls: false,
    uglify: {
        uglifyOptions: {
            parallel: 8,
            compress: {
                drop_console: true,
            },
        },
    },
})
    .webpackConfig({
        devtool: 'source-map',
        resolve: {
            symlinks: false,
            alias: {
                '@': path.resolve(__dirname, 'resources/js/'),
                '~': path.resolve(__dirname, 'node_modules/'),
            },
        },
        plugins: [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)],
    })
    .js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.postcss', 'public/css')
    .tailwind('./tailwind.config.js')
    .styles([
        'node_modules/vue-toast-notification/dist/theme-default.css',
        'node_modules/vue-select/dist/vue-select.css',
        'node_modules/flatpickr/dist/themes/airbnb.css',
        'node_modules/sweetalert2/dist/sweetalert2.min.css'
    ], 'public/css/vendors.css');

if (mix.inProduction()) {
    mix.version();
}
else {
    mix.browserSync({
        proxy: process.env.APP_DOMAIN,
        files: [
            'resources/views/**/*.php',
            'public/js/**/*.js',
            'public/css/**/*.css'
        ],
    })
}