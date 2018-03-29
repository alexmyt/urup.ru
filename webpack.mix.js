const path = require('path');
const mix = require('laravel-mix');
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

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
    .js('resources/assets/js/app.js', 'public/js')
//    .js('resources/assets/js/font-awesome.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/custom.scss', 'public/css')
    .sourceMaps();
//    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
    mix.extract([
        'vue',
        'axios',
        'jquery',
        'popper.js',
        'bootstrap',
        '@fortawesome/fontawesome'
    ]);
}

mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');


mix.webpackConfig({
  plugins: [
    // new BundleAnalyzerPlugin()
  ],
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/assets/js')
    }
  },
  output: {
//    chunkFilename: 'js/[name].[chunkhash].js',
//    publicPath: mix.config.hmr ? '//localhost:8080' : '/'
  }
});
