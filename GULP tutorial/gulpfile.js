var gulp = require('gulp');
var prefix = require('gulp-autoprefixer');
var css_min = require('gulp-csso');
var tinyIMG = require('gulp-tinify'); //минифицирует картинки
var clean = require('gulp-clean-dest'); //удаляет файлы из указанной директории
var changed = require('gulp-changed');
var img_min = require('gulp-imagemin');//минифицирует картинки, но хуже чем gulp-tinify

gulp.task('prefix', function() {
    gulp.src('tmp/css/**/*.css')
            .pipe(changed('new'))
            .pipe(prefix({
                browsers: ['last 3 versions'],
                cascade: false
            }))
            .pipe(css_min())
            .pipe(gulp.dest('new'));
})
gulp.task('tiny', function() {
    gulp.src('img/tmp/*.*')
            .pipe(changed('img'))
            .pipe(tinyIMG('YVCmvotyXCvqVpsNNb8zbz2HgZtWBlWH'))
            .pipe(gulp.dest('img'))

})

gulp.task('img_min', function() {
    gulp.src('img_new/*')
            .pipe(img_min())
            .pipe(gulp.dest('new_img'))
})
gulp.task('watch', function() {
    gulp.watch('tmp/css/**/*.css', ['prefix']);
    gulp.watch('img/tmp/*.*', ['tiny']);

})