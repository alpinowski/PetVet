'use strict';

// sass compile
var gulp = require('gulp');
var sass = require('gulp-sass');
var prettify = require('gulp-prettify');
var minifyCss = require("gulp-minify-css");
var rename = require("gulp-rename");
var uglify = require("gulp-uglify");
var rtlcss = require("gulp-rtlcss");
var connect = require('gulp-connect');

//*** Localhost server tast
gulp.task('localhost', function() {
  connect.server();
});

gulp.task('localhost-live', function() {
  connect.server({
    livereload: true
  });
});

//*** SASS compiler task
gulp.task('sass', function () {
  // bootstrap compilation
	gulp.src('./petvet/sass/bootstrap.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/global/plugins/bootstrap/css/'));

  // select2 compilation using bootstrap variables
	gulp.src('./petvet/assets/global/plugins/select2/sass/select2-bootstrap.min.scss').pipe(sass({outputStyle: 'compressed'})).pipe(gulp.dest('./petvet/assets/global/plugins/select2/css/'));

  // global theme stylesheet compilation
	gulp.src('./petvet/sass/global/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/global/css'));
	gulp.src('./petvet/sass/apps/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/apps/css'));
	gulp.src('./petvet/sass/pages/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/pages/css'));

  // theme layouts compilation
	gulp.src('./petvet/sass/layouts/layout/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout/css'));
  gulp.src('./petvet/sass/layouts/layout/themes/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout/css/themes'));

  gulp.src('./petvet/sass/layouts/layout2/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout2/css'));
  gulp.src('./petvet/sass/layouts/layout2/themes/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout2/css/themes'));

  gulp.src('./petvet/sass/layouts/layout3/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout3/css'));
  gulp.src('./petvet/sass/layouts/layout3/themes/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout3/css/themes'));

  gulp.src('./petvet/sass/layouts/layout4/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout4/css'));
  gulp.src('./petvet/sass/layouts/layout4/themes/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout4/css/themes'));

  gulp.src('./petvet/sass/layouts/layout5/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout5/css'));

  gulp.src('./petvet/sass/layouts/layout6/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout6/css'));

  gulp.src('./petvet/sass/layouts/layout7/*.scss').pipe(sass()).pipe(gulp.dest('./petvet/assets/layouts/layout7/css'));
});

//*** SASS watch(realtime) compiler task
gulp.task('sass:watch', function () {
	gulp.watch('./petvet/sass/**/*.scss', ['sass']);
});

//*** CSS & JS minify task
gulp.task('minify', function () {
    // css minify
    gulp.src(['./petvet/assets/apps/css/*.css', '!./petvet/assets/apps/css/*.min.css']).pipe(minifyCss()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/apps/css/'));

    gulp.src(['./petvet/assets/global/css/*.css','!./petvet/assets/global/css/*.min.css']).pipe(minifyCss()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/global/css/'));
    gulp.src(['./petvet/assets/pages/css/*.css','!./petvet/assets/pages/css/*.min.css']).pipe(minifyCss()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/pages/css/'));

    gulp.src(['./petvet/assets/layouts/**/css/*.css','!./petvet/assets/layouts/**/css/*.min.css']).pipe(rename({suffix: '.min'})).pipe(minifyCss()).pipe(gulp.dest('./petvet/assets/layouts/'));
    gulp.src(['./petvet/assets/layouts/**/css/**/*.css','!./petvet/assets/layouts/**/css/**/*.min.css']).pipe(rename({suffix: '.min'})).pipe(minifyCss()).pipe(gulp.dest('./petvet/assets/layouts/'));

    gulp.src(['./petvet/assets/global/plugins/bootstrap/css/*.css','!./petvet/assets/global/plugins/bootstrap/css/*.min.css']).pipe(minifyCss()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/global/plugins/bootstrap/css/'));

    //js minify
    gulp.src(['./petvet/assets/apps/scripts/*.js','!./petvet/assets/apps/scripts/*.min.js']).pipe(uglify()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/apps/scripts/'));
    gulp.src(['./petvet/assets/global/scripts/*.js','!./petvet/assets/global/scripts/*.min.js']).pipe(uglify()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/global/scripts'));
    gulp.src(['./petvet/assets/pages/scripts/*.js','!./petvet/assets/pages/scripts/*.min.js']).pipe(uglify()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/pages/scripts'));
    gulp.src(['./petvet/assets/layouts/**/scripts/*.js','!./petvet/assets/layouts/**/scripts/*.min.js']).pipe(uglify()).pipe(rename({suffix: '.min'})).pipe(gulp.dest('./petvet/assets/layouts/'));
});

//*** RTL convertor task
gulp.task('rtlcss', function () {

  gulp
    .src(['./petvet/assets/apps/css/*.css', '!./petvet/assets/apps/css/*-rtl.min.css', '!./petvet/assets/apps/css/*-rtl.css', '!./petvet/assets/apps/css/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/apps/css'));

  gulp
    .src(['./petvet/assets/pages/css/*.css', '!./petvet/assets/pages/css/*-rtl.min.css', '!./petvet/assets/pages/css/*-rtl.css', '!./petvet/assets/pages/css/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/pages/css'));

  gulp
    .src(['./petvet/assets/global/css/*.css', '!./petvet/assets/global/css/*-rtl.min.css', '!./petvet/assets/global/css/*-rtl.css', '!./petvet/assets/global/css/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/global/css'));

  gulp
    .src(['./petvet/assets/layouts/**/css/*.css', '!./petvet/assets/layouts/**/css/*-rtl.css', '!./petvet/assets/layouts/**/css/*-rtl.min.css', '!./petvet/assets/layouts/**/css/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/layouts'));

  gulp
    .src(['./petvet/assets/layouts/**/css/**/*.css', '!./petvet/assets/layouts/**/css/**/*-rtl.css', '!./petvet/assets/layouts/**/css/**/*-rtl.min.css', '!./petvet/assets/layouts/**/css/**/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/layouts'));

  gulp
    .src(['./petvet/assets/global/plugins/bootstrap/css/*.css', '!./petvet/assets/global/plugins/bootstrap/css/*-rtl.css', '!./petvet/assets/global/plugins/bootstrap/css/*.min.css'])
    .pipe(rtlcss())
    .pipe(rename({suffix: '-rtl'}))
    .pipe(gulp.dest('./petvet/assets/global/plugins/bootstrap/css'));
});

//*** HTML formatter task
gulp.task('prettify', function() {

  	gulp.src('./**/*.html').
  	  	pipe(prettify({
    		indent_size: 4,
    		indent_inner_html: true,
    		unformatted: ['pre', 'code']
   		})).
   		pipe(gulp.dest('./'));
});