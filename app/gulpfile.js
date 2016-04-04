var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync');

gulp.task('hello', function() {
	console.log('Hello toi');
});

gulp.task('sass', function() {
  return gulp.src('views/assets/scss/**/*.scss')
  .pipe(sass())
  .pipe(gulp.dest('views/assets/css'))
  .pipe(browserSync.reload({
  	stream: true
  }))
});

gulp.task('browserSync', function() {
	browserSync({
		server: {
			baseDir: 'views/',
                    index: 'sign.html' // BRUT
		},
	})
})
gulp.task('compile', function () {
    'use strict';
    var twig = require('gulp-twig');
    return gulp.src('./views/Index/sign.html') // BRUT vue a changer selon sur laquel on travail attention css
        .pipe(twig({
            data: {
                title: 'Gulp and Twig',
                benefits: [
                    'Fast',
                    'Flexible',
                    'Secure'
                ]
            }
        }))
        .pipe(gulp.dest('./views'));
});

gulp.task('watch', ['compile','browserSync', 'sass'], function (){
      gulp.watch('views/**/*.html', ['compile']);
	gulp.watch('views/assets/scss/**/*.scss', ['sass']);
	gulp.watch('views/**/*.html', browserSync.reload);
	gulp.watch('views/assets/js/**/*.js', browserSync.reload);
});
var gulp = require('gulp');
