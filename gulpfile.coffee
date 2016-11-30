path =
  css: "css/"
  scss: "css/"

gulp = require('gulp')
$ = require('gulp-load-plugins')()

gulp.task 'default', ->
  gulp.watch "#{path.scss}/*.scss", ['sass']

gulp.task 'sass', ->
    gulp.src "#{path.scss}/*.scss"
    .pipe $.sass
      onError: console.error.bind(console, 'SASS Error:')
    .pipe gulp.dest path.css

