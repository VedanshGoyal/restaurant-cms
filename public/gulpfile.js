'use strict';

var gulp = require('gulp');
var tasks = require('./gulptasks');

gulp.task('build:frontpage', ['app:frontpage', 'vendor:frontpage', 'sass:frontpage']);
gulp.task('build:dash', ['app:dash', 'vendor:dash', 'sass:dash']);

gulp.task('vendor:frontpage', function () {
    var opts = {
        debug: true,
        buildFile: 'frontpage-vendor.js',
        buildPath: './build',
        requireOnly: ['material-design-lite'],
    };

    tasks.packageVendor(opts);
});

gulp.task('app:frontpage', function() {
    var opts = {
        debug: true,
        source: './js/frontpage.js',
        buildFile: 'frontpage.js',
        buildPath: './build',
    };

    tasks.packageApp(opts);
});

gulp.task('sass:frontpage', function() {
    var opts = {
        source: './sass/frontpage.scss',
        buildFile: 'frontpage.css',
        buildPath: './build',
    };

    tasks.packageSass(opts);
});

gulp.task('vendor:dash', function () {
    var opts = {
        debug: true,
        buildFile: 'dash-vendor.js',
        buildPath: './build',
    };

    tasks.packageVendor(opts);
});

gulp.task('app:dash', function() {
    var opts = {
        debug: true,
        source: './js/dash.js',
        buildFile: 'dash.js',
        buildPath: './build',
    };

    tasks.packageApp(opts);
});

gulp.task('sass:dash', function() {
    var opts = {
        source: './sass/dash.scss',
        buildFile: 'dash.css',
        buildPath: './build',
    };

    tasks.packageSass(opts);
});

gulp.task('watch:frontpage', function () {
    tasks.setWatcher({watchPath: './js/frontpage.js', task: 'app:frontpage'});
    tasks.setWatcher({watchPath: './sass/**/*.scss', task: 'sass:frontpage'});
});

gulp.task('watch:dash', function () {
    tasks.setWatcher({watchPath: ['./js/**/*.js', './js/templates/*.html'], task: 'app:dash'});
    tasks.setWatcher({watchPath: './sass/**/*.scss', task: 'sass:dash'});
});
