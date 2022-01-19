var localhost = 'https://webxrsummitseries/' // SET local dev url here
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

function print_css() {
    return src(['app/sass/print.scss'], {
            sourcemaps: true
        })
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

function xr_css() {
    return src(['xr/css/xr.scss'], {
            sourcemaps: true
        })
        .pipe(sass())
        .pipe(dest('./'))
        .pipe(minifyCSS())
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(cssnano())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'XR converted to SCSS '
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

function xr_lib() {
    return src('xr/js/lib/**/*.js', {
        sourcemaps: true
    })

    .pipe(babel({
        presets: ['@babel/preset-env']
    }))

    .pipe(concat('xr-lib.js'))
        .pipe(dest('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'XR LIB compiled'
        }))
}


function xr_app() {

    return src('app/xr/**/*.js', {
        sourcemaps: true
    })



    .pipe(concat('xr.js'))
        .pipe(dest('./'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(dest('./'))
        .pipe(notify({
            message: 'XR APP compiled'
        }))
}

function clean() {
    return del(['./style.css', './style.min.css'])

}

function xr_clean() {
    return del(['./xr.css', './xr.min.css'])

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

    //until I put this in webpack.
    watch('./xr/css/**/*.scss', xr_clean);
    watch('./xr/css/**/*.scss', xr_css).on('change', browserSync.reload);
    //watch('./xr/js/lib/**/*.js', xr_lib).on('change', browserSync.reload);
    watch('./app/xr/**/*.js', xr_app).on('change', browserSync.reload);

}

// Clean


exports.css = css;
exports.js = js;
exports.default = browser;