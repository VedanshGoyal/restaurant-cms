'use strict';

var _ = require('lodash');
var gulp = require('gulp');
var sass = require('gulp-sass');
var gutil = require('gulp-util');
var browserify = require('browserify');
var source = require('vinyl-source-stream');
var rename = require('gulp-rename');
var mochaPhantomJS = require('gulp-mocha-phantomjs');
var vendorManifest = require('./vendor.json');
var tasks = {};

module.exports = _.extend(tasks, {

    packageVendor: function(opts) {
        var bundle = browserify(opts);
        var vendorIds = getVendorIds(opts.requireOnly);

        vendorIds.forEach(function(id) {
            bundle.require(vendorManifest[id], {expose: id});
        });

        var stream = bundle.bundle().on('error', gutil.log).pipe(source(opts.buildFile));
        return stream.pipe(gulp.dest(opts.buildPath));
    },

    packageApp: function(opts) {
        var bundle = browserify(opts.source, opts);
        var vendorIds = getVendorIds(opts.requireOnly);

        vendorIds.forEach(function(id) {
            bundle.external(id);
        });

        var stream = bundle.bundle().on('error', gutil.log).pipe(source(opts.buildFile));
        return stream.pipe(gulp.dest(opts.buildPath));
    },

    packageTests: function(opts) {
        var bundle = browserify(opts.source, opts);
        var vendorIds = getVendorIds(opts.requireOnly);

        vendorIds.forEach(function(id) {
            bundle.external(id);
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
            .on('error', gutil.log);

    },

    setWatcher: function(opts) {
        var stream = gulp.watch(opts.watchPath);

        stream.on('change', function () {
            gulp.start(opts.task);
        });
    },

});

function getVendorIds(requireOnly) {
    var packageKeys = _.keys(vendorManifest);
    return _.intersection(packageKeys, requireOnly || packageKeys);
}
