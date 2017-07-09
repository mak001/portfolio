let mix = require('laravel-mix').mix;
let path = require('path');

//this fixes an API change introduced at //https://github.com/webpack/webpack/issues/4549
mix.setPublicPath(
    path.resolve(__dirname, '')
);

mix.sass('scss/main.scss', 'css/main.css');

mix.webpackConfig({
    externals: {
        // jquery: 'jQuery'
    }
});