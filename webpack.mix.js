// webpack.mix.js
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/ckeditor-init.js', 'public/js/ckeditor-init.js')
    .js('resources/js/ckeditor.js', 'public/js') // 👈 Añadido CKEditor
    .postCss('resources/css/app.css', 'public/css', [
]);
