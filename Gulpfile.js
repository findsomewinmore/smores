'use strict';

// Node/Gulp plugins
const gulp    = require('gulp');
const merge   = require('merge-stream');
const plugins = require('gulp-load-plugins')({ camelize: true });
const through = require('through2');

// CSS task
gulp.task('styles', () => {
  return gulp.src('assets/scss/main.scss')
    .pipe(plugins.plumber())
    .pipe(plugins.sass({ outputStyle: 'compressed' }))
    .pipe(plugins.postcss([
      require('autoprefixer')({ browsers: ['last 2 versions'] })
    ]))
    .pipe(plugins.rename('styles.min.css'))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(plugins.plumber.stop())
    .pipe(gulp.dest('assets/css'))
    .pipe(plugins.size({ title: 'styles' }));
});

// Scripts task
gulp.task('scripts', () => {
  return gulp.src(['assets/js/**/*.js'])
    .pipe(plugins.plumber())
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.babel())
    .pipe(plugins.concat('scripts.min.js'))
    .pipe(plugins.uglify())
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(plugins.plumber.stop())
    .pipe(gulp.dest('_dist/assets/js'))
    .pipe(plugins.size({ title: 'scripts' }));
})

// Optimizes images
gulp.task('images', () => {
  return gulp.src('assets/img/**/*')
    .pipe(plugins.plumber())
    .pipe(plugins.imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use: [require('imagemin-pngquant')()]
    }))
    .pipe(plugins.plumber.stop())
    .pipe(gulp.dest('assets/img'))
    .pipe(plugins.size({ title: 'images' }));
});

// Build task
gulp.task('build', ['styles', 'scripts', 'images']);

// Watch task
gulp.task('watch', () => {
  gulp.watch(['_src/assets/img/**/*'], ['images']);
  gulp.watch(['_src/assets/css/**/*.css'], ['styles']);
  gulp.watch(['_src/assets/js/**/*.js'], ['scripts']);
});

// Default task
gulp.task('default', ['build', 'watch']);
