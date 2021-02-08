<?php

//ВАЖНО помнить, что данные приходящие из формы всегда являются строкой, в независимости от типа тега input!!!

$val = intval('15');			//Преобразует строку в число и возвращает его, иначе возвращает 0(остальное в доках)

//примечательно, что filter_var приведет строку к числу и проверит его(возвращает число или FALSE)
$value = "23";
echo filter_var($value, FILTER_VALIDATE_INT);

//Удалит все символы кроме цифр
$value = "2s3;";
echo filter_var($value, FILTER_SANITIZE_NUMBER_INT);

//очищающие фильтры http://php.net/manual/ru/filter.filters.sanitize.php
//валидирующие фильтры http://php.net/manual/ru/filter.filters.validate.php


//проверка по регулярке. 
$value = "a23";

// используйте этот формат для фильтров с дополнительными параметрами
$options = [
	'options' => 
		[
			'default' => 'blunder',		//можно опускать или установить любое значение возвращаеемое при несовпадении
			'regexp' => '/^[1-9]+$/'	//вписываем регулярку
		]
];

$value = filter_var($value, FILTER_VALIDATE_REGEXP, $options);
//ключи массива $option можно посмотреть в мануале по ссылкам в поле "Параметры"

$first = 100;
$second = 5;
$options = [
	'options' => 
	[
		'min_range' => -10,
		'max_range' => 10,
	]
];

if(filter_var($first, FILTER_VALIDATE_INT, $options))
	echo "$first входит в диапазон -10 .. 10<br />";
else
	echo "$first не входит в диапазон -10 .. 10<br />";

//Для кучи переменных есть 
filter_var_array($values, $options);
$values = [
	'id' => '15',
	'date' => '12-03-1994',
	'email' => 'example@test.com'
];

$options = [
	'id' => [
		'filter' => FILTER_VALIDATE_INT,
		'options' => ['min_range' = 10, 'max_range' = 100]
	],
	'date' = [
		'filter' => FILTER_VALIDATE_REGEXP,
		'options' => ['regexp' => '/\d{2}-\d{2}-\d{4}/']
	],
	'email' = [
		'filter' => FILTER_VALIDATE_EMAIL
	]
];

$result filter_var_array($values, $options);
print_r($result);     //Array ( [id] => 15 [date] => 12-03-1994 [email] => example@test.com ) 