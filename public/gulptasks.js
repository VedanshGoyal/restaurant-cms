'use strict';

var _ = require('underscore');
var fs = require('fs');
var gulp = require('gulp');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var rename = require('gulp-rename');
var bowerResolve = require('bower-resolve');
var npmResolve = require('resolve');
var mochaPhantomJS = require('gulp-mocha-phantomjs');
var tasks = {};

module.exports = _.extend(tasks, {

    packageVendor: function(opts) {
        var bundle = browserify(opts);

        getBowerIds(opts.requireOnly).forEach(function (id) {
            var path = bowerResolve.fastReadSync(id);
            bundle.require(path, {expose: id});
        });

        getNPMIds(opts.requireOnly).forEach(function (id) {
            bundle.require(npmResolve.sync(id), {expose: id});
        });

        var stream = bundle.bundle().on('error', gutil.log).pipe(source(opts.buildFile));
        return stream.pipe(gulp.dest(opts.buildPath));
    },

    packageApp: function(opts) {
        var bundle = browserify(opts.source, opts);

        getBowerIds().forEach(function (lib) {
            bundle.external(lib);
        });

        getNPMIds().forEach(function (lib) {
            bundle.external(lib);
        });

        var stream = bundle.bundle().on('error', gutil.log).pipe(source(opts.buildFile));
        return stream.pipe(gulp.dest(opts.buildPath));
    },

    packageTests: function(opts) {
        var bundle = browserify(opts.source, opts);

        getBowerIds().forEach(function (lib) {
            bundle.external(lib);
        });

        getNPMIds().forEach(function (lib) {
            bundle.external(lib);
        });

        var stream = bundle.bundle().on('error', gutil.log).pipe(source(opts.buildFile));
        return stream.pipe(gulp.dest(opts.buildPath));
    },

    packageSass: function(opts) {
        var stream = gulp.src(opts.source);

        return stream.pipe(sass({}))
            .on('error', gutil.log)
            .pipe(rename(opts.buildFile))
            .pipe(gulp.dest(opts.buildPath));
    },

    runTests: function(opts) {
        return gulp.src(opts.runnerFile)
            .pipe(mochaPhantomJS(opts))
            .on('error', function() { this.end(); });

    },

    setWatcher: function(opts) {
        var stream = gulp.watch(opts.watchPath);

        stream.on('change', function () {
            gulp.start(opts.task);
        });
    },

});

function getBowerIds(requireOnly) {
    var manifest = {};

    try {
        manifest = require('./bower.json');
    } catch (e) {
        gutil.log(gutil.colors.bgYellow('No bower.json file found:', e));
    }

    var packageKeys = _.keys(manifest.dependencies);
    return _.intersection(packageKeys, requireOnly || packageKeys);
}

function getNPMIds(requireOnly) {
    var manifest = {};

    try {
        manifest = require('./package.json');
    } catch (e) {
        gutil.log(gutil.colors.bgYellow('No package.json file found:', e));
    }

    var packageKeys = _.keys(manifest.dependencies);
    return _.intersection(packageKeys, requireOnly || packageKeys);
}
