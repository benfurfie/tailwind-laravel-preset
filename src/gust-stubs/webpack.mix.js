const mix = require('laravel-mix');
const tw = require('tailwindcss');
const postImport = require('postcss-import');
const postNested = require('postcss-nested');
const postSorting = require('postcss-sorting');

mix.postCss('./resources/css/app.css', './public/css', [
    postImport(),
    tw('./tailwind.config.js'),
    postNested(),
    postSorting(),
]);
mix.js('./resources/js/app.js', './public/js');
mix.options({
    processCssUrl: false
});


if (mix.inProduction()) {
    mix.version()
    mix.purgeCss();
}
