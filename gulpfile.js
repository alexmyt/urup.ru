const elixir = require('laravel-elixir');

elixir.config.sourcemaps = true;

elixir(function(mix) {
    mix.sass('app.scss','public/css')
	.sass('custom.scss','public/css')
        .browserify('app.js','public/js')
	.copy('node_modules/font-awesome/fonts','public/build/fonts')
	.version(['css/app.css','css/custom.css','js/app.js']);
});