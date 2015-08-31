'use strict';

var gulp = require('gulp');
var tasks = require('./gulptasks');

gulp.task('build', ['vendor', 'app', 'test', 'sass']);
gulp.task('build-frontpage', ['frontpage', 'frontpage-vendor']);

gulp.task('frontpage-vendor', function () {
    var opts = {
        debug: true,
        buildFile: 'frontpage-vendor.js',
        buildPath: './build',
        requireOnly: ['material-design-lite'],
    };

    tasks.packageVendor(opts);
});

gulp.task('frontpage', function() {
    var opts = {
        debug: true,
        source: './js/frontpage.js',
        buildFile: 'frontpage.js',
        buildPath: './build',
    };

    tasks.packageApp(opts);
});

gulp.task('frontpage-sass', function() {
    var opts = {
        source: './sass/frontpage.scss',
        buildFile: 'frontpage.css',
        buildPath: './build',
    };

    tasks.packageSass(opts);
});


gulp.task('test', function() {
    var opts = {
        debug: true,
        source: './test/tests.js',
        buildFile: 'tests.js',
        buildPath: './build',
        runnerFile: './test/runner.html',
        reporter: 'dot',
    };

    tasks.packageTests(opts)
    .on('end', function() { tasks.runTests(opts); });
});

gulp.task('watch', function () {
    tasks.setWatcher({watchPath: './js/frontpage.js', task: 'frontpage'});
    tasks.setWatcher({watchPath: './sass/**/*.scss', task: 'frontpage-sass'});
});
