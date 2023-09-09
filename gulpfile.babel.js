var localhost = 'https://thepolys/' // SET local dev url here
//var localhost = 'http://1me.192.168.1.19.xip.io' // SET local dev url here

const { gulp, src, dest, watch } = require('gulp'),
    sass = require('gulp-sass'),
    minifyCSS = require('gulp-csso'),
    babel = require('@babel/core'),
    //babel = require('gulp-babel'),
    autoprefixer = require('autoprefixer'),
    cssnano = require('gulp-cssnano'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify-es').default,
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    sourcemaps = require('gulp-sourcemaps'),
    identityMap = require('@gulp-sourcemaps/identity-map'),

    browserSync = require('browser-sync').create(),
    del = require('del')

function css() {
    return src(['app/sass/style.scss'], { sourcemaps: true })
    .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(dest('./'))
        .pipe(minifyCSS())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(cssnano())
        .pipe(sourcemaps.write('.')) // Write the sourcemaps to a separate file
        .pipe(dest('./'))
        .pipe(notify({
            message: 'SCSS converted to SCSS '
        }))
        .pipe(browserSync.stream())
}


function print_css() {
    return src(['app/sass/print.scss'], {
            sourcemaps: true
        })
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(dest('./'))
        .pipe(minifyCSS())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(cssnano())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'SCSS converted to SCSS '
        }))
        .pipe(browserSync.stream())
}


function js() {
    return src('app/js/custom/**/*.js', {
            sourcemaps: true
        })
        /*
        .pipe(babel({
            presets: ['@babel/env']
        }))
*/
        .pipe(concat('main.js'))
        .pipe(dest('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'JS compiled'
        }))
}

function vendor() {
    return src('app/js/vendor/**/*.js', {
            sourcemaps: true
        })
        /*
        .pipe(babel({
                presets: ['@babel/preset-env']
            }))*/
        .pipe(concat('vendor.js'))
        .pipe(dest('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'JS compiled'
        }))
}


function clean() {
    return del(['./style.css', './style.min.css'])

}



function print_clean() {
    return del(['./print.css', './print.min.css'])

}

function browser() {
    browserSync.init({
        proxy: localhost,
        files: [
            './**/*.php',
            './**/*.scss',
            './**/*.js'

        ]
    });
    watch('./app/sass/**/*.scss', clean);
    watch('./app/sass/**/*.scss', css).on('change', browserSync.reload);
    watch('./app/js/custom/**/*.js', js).on('change', browserSync.reload);
    watch('./app/js/vendor/**/*.js', vendor).on('change', browserSync.reload);


    watch('./app/sass/print.scss', print_clean);
    watch('./app/sass/print.scss', print_css).on('change', browserSync.reload);

}

// Clean


exports.css = css;
exports.js = js;
exports.default = browser;