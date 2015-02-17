/*
 See dev dependencies https://gist.github.com/isimmons/8927890
 Compiles sass to compressed css with autoprefixing
 Compiles coffee to javascript
 Livereloads on changes to coffee, sass, and blade templates
 Runs PHPUnit tests
 Watches sass, coffee, blade, and phpunit
 Default tasks sass, coffee, phpunit, watch
 */
var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var gutil = require('gulp-util');
var concat = require('gulp-concat');

gulp.task('minifycss', function() {
    gulp.src('./public/assets/css/main.css')
        .pipe(minifycss({keepBreaks:false}))
        .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1'))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./public/assets/css'));
});

gulp.task('less', function () {
    gulp.src('./public/assets/less/main.less')
        .pipe(less({
            paths: [path.join(__dirname, 'less', 'includes')]
        }))
        .pipe(gulp.dest('./public/assets/css'));
});


gulp.task('compress', function() {

    gulp.src('./public/assets/jsdev/**/**/*.js')
        .pipe(uglify())
        .pipe(concat('main.min.js'))
        .pipe(gulp.dest('./public/assets/js'))
});


gulp.task('watch', function () {

    gulp.watch('public/assets/less/**/*.less', ['less', 'version']);
    gulp.watch('public/assets/jsdev/**/**/*.js', ['compress', 'version']);
    gulp.watch('public/assets/css/main.css', ['minifycss']);
});

gulp.task('version', function () {
    var file = '<?php return "'+makeid()+'"; ';
    require('fs').writeFile('.version.php', file);
})


function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 10; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}


/* Default Task */

gulp.task('default', ['less', 'watch', 'minifycss', 'compress', 'version']);

