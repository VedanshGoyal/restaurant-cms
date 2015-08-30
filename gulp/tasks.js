var gulp = require('gulp');
var config = require('./config.js');
var browserify = require('gulp-browserify');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var mochaPhantomJS = require('gulp-mocha-phantomjs');
var gutil = require('gulp-util');
var sass = require('gulp-sass');

var jsConfig = config.js
var sassConfig = config.sass;
var testConfig = config.test;

/**
 * Build ES6 code with browserify
 *
 * @param object opts - configuration options to set for build
 *          {
 *              debug:bool,
 *              fullSourcePath:string, 
 *              buildName:string,
 *              buildPath:string,
 *              prebundleAction:string(internal/external),
 *              transforms:array,
 *              vendorLibs:array,
 *
 *          }
 * @return stream
 */
exports.buildES6 = function(opts) {
    var stream = gulp.src(opts.fullSourcePath, {read: false})
                    .pipe(browserify({
                        debug: opts.debug || false,
                        transform: opts.transforms || [],
                    })).on('prebundle', function (bundle) {
                        if (opts.prebundleAction && opts.vendorLibs) {
                            opts.vendorLibs.forEach(function (lib) {
                                bundle[opts.prebundleAction](lib);
                            });
                        }
                    });

    if (config.env === 'production') { stream.pipe(uglify()); }

    return stream.pipe(rename(addMinExt(opts.buildFile))).pipe(gulp.dest(opts.buildPath));
};

/**
 * Build Sass code with gulp-sass
 *
 * @param object opts - configuration options to set for build
 * @return stream
 */
exports.buildSass = function (opts) {
    var outputStyle = (config.env === 'production') ? 'compressed' : 'expanded';
    var stream = gulp.src(opts.fullSourcePath);

    return stream.pipe(sass({outputStyle: outputStyle}))
        .pipe(rename(addMinExt(opts.buildFile)))
        .pipe(gulp.dest(opts.buildPath));
};

/**
 * Start a watcher
 *
 * @param string sourcePath - root path watcher will start from
 * @param string watchPattern - glob watch pattern
 * @param string task - job to run on change
 * @return void
 */
exports.setWatcher = function(sourcePath, watchPattern, task) {
    var stream = gulp.watch(sourcePath + watchPattern);

    stream.on('change', function () {
        gulp.start(task, function () {
            gutil.log(gutil.colors.bgGreen('building ' + task));
        });
    });
};

/**
 * Run the javascript tests in phantomJS
 *
 * @param object opts - configuration options to set for build
 * @return stream
 */
exports.runTests = function (opts) {
    return gulp.src(opts.runnerFile)
        .pipe(mochaPhantomJS({reporter: opts.reporter}))
        .on('error', function() { this.end(); });
};

/**
 * Add .min extension to the filename string provided between 
 * filename and existing extension
 *
 * @param string filename
 * @return string
 */
function addMinExt(filename) {
        return (config.env === 'production') ? filename.replace(/^([^.]*)\.(.*)$/, '$1.min.$2') : filename;
};
