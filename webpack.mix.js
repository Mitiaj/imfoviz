const mix = require('laravel-mix');
const path = require("path");

mix.js('resources/js/app.js', 'public/js')
    .alias({
        '@': path.resolve('resources/js'),
    })
    .vue()

    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);

// mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'resources/webfonts');


if (mix.inProduction()) {
    mix.version();
}
