module.exports = {
    env: process.env.APP_ENV,

    sass: {
        sourcePath: './assets/sass/',
        sourceFile: 'main.scss',
        buildPath: './public/assets/',
        buildFile: 'main.css',
    },

    js: {
        sourcePath: './assets/js/',
        sourceFile: 'app.js',
        buildPath: './public/assets/',
        buildFile: 'app.js',
        watchPattern: '**/*.js',
        vendorLibs: ['babel/polyfill'],
        transforms: ['babelify'],
    },

    frontpage: {
        sourcePath: './assets/js/',
        sourceFile: 'frontpage.js',
        buildPath: './public/assets/',
        buildFile: 'frontpage.js',
        watchPattern: '**/*.js',
        vendorLibs: ['babel/polyfill'],
        transforms: ['babelify'],
    },

    test: {
        sourcePath: './assets/test/src/',
        sourceFile: 'tests.js',
        buildPath: './assets/test/build/',
        buildFile: 'tests.build.js',
        runnerFile: './assets/test/runner.html',
        reporter: 'dot',
    },
};
