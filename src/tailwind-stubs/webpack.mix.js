const mix = require('laravel-mix');

mix.postCss('./resources/css/app.css', './public/css', [
    require('postcss-import'),
    require('tailwindcss')('./tailwind.config.js'),
    require('postcss-preset-env')({stage: 0})
]);
mix.js('./resources/js/app.js', './public/js');
mix.options({
    processCssUrl: false
});


if (mix.inProduction()) {
    mix.version()
    mix.purgeCss();
}
