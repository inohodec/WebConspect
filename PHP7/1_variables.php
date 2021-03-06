<?php
/********************   ПЕРЕМЕННЫЕ   **************************/

# Типы переменных-------------------------------------
gettype($variable); //возвращает тип переменной в виде строки(string, integer , etc.)
settype($variable, $type); //устанавливает тип переменной где $variable переменная, $type тип переменной в виде строки возращаемой функцией gettype()
$val = (int) 15; //устанавливает тип переменной,
# Удаление переменной
unset($variable); //удалит переменную
unset($arr[3]); //Удалит элемент из массива(вместе с ключем)

# Жесткие ссылки---------------------------------------
$a = 10;
$b = & $a;
echo "a = $a, b = $b";//обе будут равны 10 т.к. ссылаються на одно и тоже значение
$b = 15;
echo "a = $a, b = $b";//обе будут равны 15 т.к. ссылаються на одно и тоже значение

$A = array('car' => 'BMW', 'bike' => 'Ukraine');
$bike = & $A['bike'];//можно создавать ссылки на элемент массива
$boat = & $A['boat'];//если такого объекта нет в массиве то присваивание создаст ключ 'boat' со значением NULL: 'boat' => NULL. echo выводит NULL как пустую строку

# Символические ссылки----------------------------------
$color = "red";
$room_color = "color";

echo $$room_color; /* выведет red, т.е. интерпретатор возьмет значение $room_color - color и добавит к нему символ $, что в итоге даст $color, а т.к. мы объявили переменную с етим именем ранее, то получим при выводе её значение, в данном случае "red" */

# Константы----------------------------------------------------
# !!!! константы доступны из любой области видимости
$unknown = "clear"; //здесь может быть результат POST запроса или т.п., вобщем неизвестная строка
define($unknown, 500);//определяем константу с именем "clear" и значением 500
echo $unknown;//выведет "clear"
echo constant($unknown);//выведет 500
echo constant($unknown) * 5;//выведет 500*5(2500)
defined($unknown); //проверяет константу на существование

# Отладочные функции----------------------------------------------
print_r($variable); //выводит переменную или выражения в удобочитаемом виде
var_dump($variable); //тоже что и сверху только добавляет типы данных перед элементами.
var_export($variable); //тоже что и print_r(), но возвращает корректный для php код, экранмруя спецсимволы и т.д.

# Выполнение команд в консоли--------------------------------------
$cmd = `catalog dir`; //выполнит команду заключенную в обратные кавычки в командной строке и поместит вывод в переменную $cmd.
