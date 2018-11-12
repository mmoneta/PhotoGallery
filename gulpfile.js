var gulp = require('gulp'),
sass = require('gulp-sass'),
browserSync = require('browser-sync');

// Development Tasks 
// -----------------

// Start browserSync server
gulp.task('browserSync', function() {
  browserSync({
    server: {
      baseDir: 'assets'
    }
  })
})

gulp.task('sass', function() {
  return gulp.src('assets/scss/**/*.scss') // Gets all files ending with .scss in app/scss and children dirs
    .pipe(sass().on('error', sass.logError)) // Passes it through a gulp-sass, log errors to console
    .pipe(gulp.dest('assets/css')) // Outputs it in the css folder
    .pipe(browserSync.reload({ // Reloading with Browser Sync
      stream: true
    }));
})

// Watchers
gulp.task('watch', ['browserSync', 'sass'], function() {
  gulp.watch('assets/scss/**/*.scss', ['sass']);
  gulp.watch('assets/*.html', browserSync.reload);
  gulp.watch('assets/js/**/*.js', browserSync.reload);
})