var gulp = require('gulp'),
    config = require('./gulp/config'),
    tasks = require('./gulp/tasks'),
    _ = require('underscore');

var jsConfig = config.js,
    sassConfig = config.sass,
    testConfig = config.test,
    fpConfig = config.frontpage;

gulp.task('build', ['app', 'vendor', 'sass', 'frontpage']);
gulp.task('default', ['watch']);

gulp.task('app', function () {
    var opts = _.extend({
        debug: true,
        fullSourcePath: jsConfig.sourcePath + jsConfig.sourceFile,
        prebundleAction: 'external',
    }, jsConfig);

    tasks.buildES6(opts); 
});

gulp.task('frontpage', function () {
    var opts = _.extend({
        debug: true,
        fullSourcePath: fpConfig.sourcePath + fpConfig.sourceFile,
        prebundleAction: 'require',
    }, fpConfig);

    tasks.buildES6(opts); 
});

gulp.task('vendor', function () {
    var opts = _.extend(jsConfig, {
        debug: false,
        fullSourcePath: './gulp/noop.js',
        prebundleAction: 'require',
        transforms: [],
        buildFile: 'vendor.js',
    });

    tasks.buildES6(opts); 
});

gulp.task('test', function () {
    var opts = _.extend(testConfig, {
        debug: false,
        fullSourcePath: testConfig.sourcePath + testConfig.sourceFile,
        transforms: jsConfig.transforms,
    });

    tasks.buildES6(opts).on('end', function () { tasks.runTests(opts); });
});

gulp.task('sass', function () {
    var opts = _.extend(sassConfig, {
        fullSourcePath: sassConfig.sourcePath + sassConfig.sourceFile,
    });

    tasks.buildSass(opts);
});

gulp.task('watch', function () {
    tasks.setWatcher(jsConfig.sourcePath, jsConfig.watchPattern, 'app');
    tasks.setWatcher('./node_modules/', jsConfig.watchPattern, 'vendor');
    tasks.setWatcher(sassConfig.sourcePath, sassConfig.sourceFile, 'sass');
    tasks.setWatcher(testConfig.sourcePath, jsConfig.watchPattern, 'test');
    tasks.setWatcher(fpConfig.sourcePath, fpConfig.sourceFile, 'frontpage');
});
