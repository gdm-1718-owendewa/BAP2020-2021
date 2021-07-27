const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/calendar.js', 'public/js')
    .js('resources/js/datepicker.js', 'public/js')
    .js('resources/js/timefield.js', 'public/js')
    .js('resources/js/tutorial.js', 'public/js')
    .js('resources/js/notes.js', 'public/js')
    .js('resources/js/courseforms.js', 'public/js')
    .js('resources/js/coursecontentforms.js', 'public/js')
    .js('resources/js/threadforms.js', 'public/js')
    .js('resources/js/tutorialforms.js', 'public/js')
    .js('resources/js/articleforms.js', 'public/js')
    .js('resources/js/eventforms.js', 'public/js')
    .js('resources/js/profileforms.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .js('resources/js/pdfdownload.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/main.scss', 'public/css')
    .sass('resources/sass/header.scss', 'public/css')
    .sass('resources/sass/footer.scss', 'public/css')
    .sass('resources/sass/about.scss', 'public/css')
    .sass('resources/sass/terms.scss', 'public/css')
    .sass('resources/sass/contact.scss', 'public/css')
    .sass('resources/sass/guide.scss', 'public/css')
    .sass('resources/sass/forms.scss', 'public/css')
    .sass('resources/sass/home.scss', 'public/css')
    .sass('resources/sass/calender.scss', 'public/css')
    .sass('resources/sass/tutorial.scss', 'public/css')
    .sass('resources/sass/article.scss', 'public/css')
    .sass('resources/sass/event.scss', 'public/css')
    .sass('resources/sass/course.scss', 'public/css')
    .sass('resources/sass/thread.scss', 'public/css')
    .sass('resources/sass/notes.scss', 'public/css')
    .sass('resources/sass/comment.scss', 'public/css')
    .sass('resources/sass/policy.scss', 'public/css')
    .sass('resources/sass/storage.scss', 'public/css')
    .sass('resources/sass/datepicker.scss', 'public/css')
    .sass('resources/sass/test.scss', 'public/css')
    .sass('resources/sass/pdf.scss', 'public/css')
    .sass('resources/sass/styles.scss', 'public/css');

