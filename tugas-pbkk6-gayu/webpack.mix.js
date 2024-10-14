const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .vue()
    .postCss("resources/css/app.css", "public/css")
    .sass("resources/sass/app.scss", "public/css")
    .version();

// Add this line if you're using history mode in Vue Router
mix.webpackConfig({
    output: {
        chunkFilename: "js/[name].js?id=[chunkhash]",
    },
});
