const { src, dest, watch, series, parallel } = require('gulp');
const sass = require('gulp-sass');
const rename = require('gulp-rename');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const php = require('gulp-connect-php');
const browserSync = require('browser-sync').create();
const paths = {
    scss: {
      src: './src/styles/*.scss',
      dest: './build/css/'
    },
    js: {
      src: './src/js/*.js',
      dest: './build/js/'
    }
};
function compileSass() {
    return src(paths.scss.src)
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'
      }))
      .pipe(rename({ extname: ".min.css" }))
      .pipe(sourcemaps.write())
      .pipe(dest(paths.scss.dest))
      .pipe(browserSync.stream());
}
function compileJs() {
return src(paths.js.src)
    .pipe(sourcemaps.init())
    .pipe(concat('all.js'))
    .pipe(sourcemaps.write())
    .pipe(dest(paths.js.dest))
    .pipe(browserSync.stream());
}

function watchSass() {
    watch(paths.scss.src, compileSass)
}
function watchJs() {
    watch(paths.js.src, compileJs)
}
function watchPhp() {
    watch(['./**/*.html', './**/*.php']).on('change', browserSync.reload);
}

exports.default = series(compileSass, compileJs, parallel(sync, watchSass, watchJs, watchPhp))

function sync() {
    php.server({
      base: './',
      port: 3000,
      keepalive: true,
      // custom PHP locations
      bin: '',
      ini: '',
    });
    browserSync.init({
      proxy: "localhost:3000",
      baseDir: "./",
      notify: false,
    });
  }