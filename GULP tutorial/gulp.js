/*
Для использования командной строки в NetBeans нужно установить Cygwin
Устанавливаем node.js
Далее устанавливаем GULP глобально из командной строки

npm i -g gulp

переходим в папку проэкта из консоли винды или NetBeans(что удобнее, т.к. в окне IDE)

cd /d D:\xammp\htdocs\myp_roject     - ключ "/d" необходим для смены диска иначе не выйдет

создаём package.json командой:

npm init - или вручную.

устанавливаем gulp локально в проэкт:

npm install gulp --save-dev  

далее создаем файл gulpfile.js из проводника, IDE или cmd:

echo > gulpfile.js

далее устанавливаем пакеты

npm i --save-dev gulp-sass
npm i --save-dev gulp-changed - и т.д по необходимости.

все зависимости записываются в "package.json"
теперь нужно заполнить и настроить наш gulpfile.js:

*/


//Добавляем сами пакеты и присваиваем им произвольные заначения для дальнейшей работы 
var gulp = require('gulp');
var prefix = require('gulp-autoprefixer');
var css_min = require('gulp-csso');
var tinyIMG = require('gulp-tinify');
var clean = require('gulp-clean-dest');
var changed = require('gulp-changed');

//Создаем таски с произвольным именем
gulp.task('prefix', function() {
    gulp.src('tmp/**')
            .pipe(prefix({
                browsers: ['last 3 versions'],
                cascade: false
            }))
            .pipe(css_min())
            .pipe(gulp.dest('new'));
})

gulp.task('tiny', function() {
    gulp.src('img/tmp/*.*')
            .pipe(tinyIMG('YVCmvotyXCvqVpsNNb8zbz2HgZtWBlWH'))
            .pipe(gulp.dest('img'))
            .pipe(clean('img/tmp'));
})

/*-------------------Пути--------------------------*/
//1 *.scss  - выберет все файлы scss в текущей(обычно крневой) директории
//2 **/*.scss - выберет все файлы scss в текущей и всех поддиректориях
//3 !not-me.scss - исключит файл not-me.scss
//4 *.+(scss|sass) - выберет все файлы scss и sass

//gulp.src(['js/**/*.js', '!js/**/*.min.js'])


/*------------------Обработчик---------------------*/

var cssMin = require('gulp-csso');
var changed = require('gulp-changed');

gulp.task('cssMin', function() {
	gulp.src('tmp/css/*.css')	 
	.pipe(changed('css')) //передает в поток только те файлы которые изменились
	.pipe(cssMin())
	.pipe(gulp.dest('css'));
})

gulp.watch('tmp/css', ['cssMin']);//непосредственно сам обработчик

//Также можно усовершенствовать вотчер для выполнения нескольких задач.


/*---------------------INSTANCES-----------------------*/

//Ver. 1
//берет картинки из указаной папки "tmp/img/" сжимает их с помощью вэбсервиса TinyPNG 
//и отправляет в другую папку "img", после чего удаляет из папки "tmp/img/" все файлы
//для того что бы не отправлять для пережатия все картинки снова
gulp.task('tiny', function() {
    gulp.src('tmp/img/*.+(png|jpg|jpeg)')
            .pipe(tinyIMG('YVCmvotyXCvqVpsNNb8zbz2HgZtWBlWH'))
            .pipe(gulp.dest('img'))
            .pipe(clean('img/tmp')); //в конце обработки полностью очищает директорию
})
//Ver. 2
//Требует плагина gulp-changed
gulp.task('tiny', function() {
    gulp.src('img/tmp/*.*')
            .pipe(changed('img')) //передает в поток только новые или измененные изображения
            .pipe(tinyIMG('YVCmvotyXCvqVpsNNb8zbz2HgZtWBlWH'))
            .pipe(gulp.dest('img'))
})