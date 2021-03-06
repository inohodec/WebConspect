<?php
//========================Автозагрузка файлов==============================
/*
	Используя данный метод мы можем подгружать большое количество классов в проэкт.
	Так же хорошим вариантом будет использовать пространства имен руководствуясь
	стандартом PSR-4:
	К примеру у нас есть index.php и класс с именем UserInfo, который лежит в папке Utils, согласно стандарту мы должны назвать файл содержащий наш класс UserInfo как UserInfo.php и неймспейс вида Utils\UesrInfo соответственно, мы получим дерево вида:
	
	index.php
	Utils
		|
		UserInfo.php
	далее что бы подключить автоматом данный файл с классом UserInfo поступаем так:
*/

# file UserInfo.php
namespace Utils;//создает префикс для классов и ф-ций в файле, по сути класс имеет имя Utils\UserInfo
class  UserInfo
{
	echo __NAMESPACE__;
}


#file index.php

spl_autoload_register( function($name) {
	$slash = DIRECTORY_SEPARATOR;//передаем разделитель путь для текущей ОС 
	$path = dirname(__FILE__).$slash.str_replace("\\", $slash, subject).".php";//var/www/html/test.max/Utils/UserInfo.php
	if(file_exists($path)) {
		require_once $path;
	}
});

$obj = new Utils\UserInfo();

/*
	Включаем автозагрузку файлов, ф-цией spl_autoload_register(), которая выполняется каждый раз как мы
	обращаемся к необъявленному классу. Она принимает имя класса, ПЕРЕВОДИТ в нижний регистр и выполняет поиск, т.е. Utils\UserInfo = utils\userInfo + добавляет расширения .inc потом .php и пытается подключить файл относительно расположения данного файла. В данном примере мы используем имена папок с верхним регистром, поэтому данный метод немного не подойдёт и мы пишем свой обработчик который не меняет регистр. Сама функция spl_autoload_register() принимает имя 
	Utils\UserInfo и передает его анонимной функции которая берет расположение файла с помощью dirname(__FILE__), заменяет в Utils\UserInfo "\" на "/", добавляет расширение .php и формирует полный АБСОЛЮТНЫЙ путь к файлу(для легкого переноса из ОС в ОС). Потом мы проверяем есть ли такой файл и если да, тогда подгружаем его. так же потом можно воспользоваться use Utils\UserInfo для псевдонима
	Мы создаем объект $obj и обращаемся к несуществующему классу

	У способа есть минус, file_exists и require_once довольно ресурсозатратны и если названия папок и
	файлов писать в нижнем регистре, то можно справиться вот так:
*/

spl_autoload_extensions(".php");//заставит использовать spl_autoload_register только .php
spl_autoload_register();//преобр. имя к нижнему регистру, добавляет .php и пытается подключить

$obj = new Utils\UserInfo();//важно что бы файл с классом был по пути utils/userinfo.php

/*код выше работает гораздо быстрее, но накладывает ограничения на имена файлов, хотя неймспейсы и имена классов внутри файлов мы можем писать с большой буквы.

================================== ПУТИ ===================================
/*
	Выше мы использоваль dirname(__FILE__) для получения абсолютного пути, но как быть, если мы 
	переместим папку Utils в подпапку Progs? В таком случае наш файл будет располагаться не в :
	/var/www/html/test.max/Utils/UserInfo.php
	,а в 
	/var/www/html/test.max/Progs/Utils/UserInfo.php
	и данный файл не подключится, вследствии чего нам придется менять код функции формирования пути файла внутри spl_autoload_register() или если мы используем её без параметров, то менять названия пространств имен при создании классов(что еще гемонрней). Но есть один хороший способ.

	spl_autoload_register() - без функции начинает свой поиск из текущего каталога, но есть способ добавить другие месита:
	1 - php.ini include_path = ".:/var/www/html/test.max/Progs"  (Linux :)
	            include_path = ".;/var/www/html/test.max/Progs"  (Windows ;)

	    Директива include_path задает пути в которых будет произведен поиск, в кавычках разделяем пути, 
	    В данном случае поиск пройдет от текущей директории "." потом если ничего не найдено, то по пути
	    /var/www/html/test.max/Progs иначе говоря с функцией внутри include_path путь можно брать так.
	    
	    $path = str_replace("\\", $slash, subject).".php"; т.е. ищем путь Utils/UserInfo от текущей папки , его там нет т.к. мы переместили его в Progs, не находим файл и ищем стартуя от
	    /var/www/html/test.max/Progs

	2 - добавить  Apache в httpd.conf : php_value include_path = ".:/var/www/html/test.max/Progs" 

	3 - Если нет боступа(хостинг), то в .htaccess : php_value include_path = ".:/var/www/html/test.max/Progs"

	4 - или прямо в сценарий set_include_path(get_include_path().PATH_SEPARATOR./var/www/html/test.max/Progs
		Используем, если нет доступа. get_include_path() , берет существующие пути из php.ini , потом мы добавляем свои. Пример ниже:
*/
set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).PATH_SEPARATOR."Progs");
