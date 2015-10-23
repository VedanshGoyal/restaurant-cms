import gulp from 'gulp';
import shell from 'gulp-shell';
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
    watch: './assets/sass/**/*.scss',
};

const sassDashOpts = {
    source: './assets/sass/dash.scss',
    outFile: 'dash.css',
    outPath: './public/css',
    watch: './assets/sass/**/*.scss',
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

gulp.task('cmd:refreshDB', shell.task(['php artisan migrate:reset && php artisan migrate --seed']));
gulp.task('cmd:refreshLoader', shell.task(['composer dumpautoload && php artisan optimize']));
gulp.task('cmd:refresh', ['cmd:refreshLoader', 'cmd:refreshDB']);
