const mix = require("laravel-mix");

mix.copyDirectory("node_modules/@fortawesome/fontawesome-pro/webfonts", "public/webfonts"); // Error with FontAwesome
mix.browserSync('https://terribooks.evo');
mix.js("resources/js/app.js", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css/app.css")
    .options({
        postCss: [require("postcss-import"), require("tailwindcss")]
    })
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
}
