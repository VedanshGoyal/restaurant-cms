import gulp from 'gulp';
import * as tasks from 'gulp-modern-tasks';

const jsMainOpts = {
    entries: ['./assets/js/main.js'],
    outFile: 'main.js',
    outPath: './public/js',
};

const jsDashOpts = {
    entries: ['./assets/js/dash.js'],
    outFile: 'dash.js',
    outPath: './public/js',
};

const sassMainOpts = {
    source: './assets/sass/main.scss',
    outFile: 'main.css',
    outPath: './public/css',
};

const sassDashOpts = {
    source: './assets/sass/dash.scss',
    outFile: 'dash.css',
    outPath: './public/css',
};

gulp.task('compile:js:main', () => tasks.compileJS(jsMainOpts));
gulp.task('compile:js:dash', () => tasks.compileJS(jsDashOpts));

gulp.task('compile:sass:main', () => tasks.compileSASS(sassMainOpts));
gulp.task('compile:sass:dash', () => tasks.compileSASS(sassDashOpts));

gulp.task('watch:main', () => {
    global.watch = true;
    gulp.watch(sassMainOpts.watch, ['compile:sass:main']);
    tasks.compileJS(jsMainOpts);
});

gulp.task('watch:dash', () => {
    global.watch = true;
    gulp.watch(sassMainOpts.watch, ['compile:sass:dash']);
    tasks.compileJS(jsDashOpts);
});

gulp.task('watch:all', ['watch:main', 'watch:dash']);

gulp.task('build:main', ['compile:js:main', 'compile:sass:main']);
gulp.task('build:dash', ['compile:js:dash', 'compile:sass:dash']);
gulp.task('build:all', ['build:main', 'build:dash']);
