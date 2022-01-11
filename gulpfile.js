const gulp = require('gulp');
const sass = require('gulp-sass')(require('node-sass'));
const sourcemaps = require('gulp-sourcemaps');
const del = require('del');


gulp.task('theme-styles', () => {
    return gulp.src('sass/style.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});
gulp.task('404-styles', () => {
    return gulp.src('sass/404-styles.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});
gulp.task('block-styles', () => {
    return gulp.src('sass/block-styles.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});

gulp.task('slick-styles', () => {
    return gulp.src('sass/slick.scss')
      .pipe(sourcemaps.init())
      .pipe(sass({
        outputStyle: 'compressed'//nested, expanded, compact, compressed
      }).on('error', sass.logError))
      .pipe(sourcemaps.write('.'))
      .pipe(gulp.dest('./css/'))
});


gulp.task('clean', () => {
    return del([
        'inc/css/block-styles.css',
    ]);
});

gulp.task('watch', () => {
  gulp.watch('sass/*.scss', (done) => {
    gulp.series(['theme-styles'])(done);
  });
});

gulp.task('default', gulp.series(['clean', 'theme-styles', 'block-styles', 'slick-styles', '404-styles', 'watch']));
