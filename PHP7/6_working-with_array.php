<?php
//======================Сортировка массивов========================

#-----------По Алфавиту или Числовому значению--------------------
//Все функции сортировки выбирают способ автоматом, но можно указать вручную атрибут SORT_NUMERIC или 
//SORT_STRING
$arr = ['тушенка','айболит','ласточка','синяк'];

//---По значению---
arsort($arr);//по убыванию, ничего не возвращает, только сортирует
asort($arr);//по возрастанию, ничего не возвращает, только сортирует

var_dump($arr);//[1]=> "айболит" [2]=> "ласточка" [3]=> "синяк" [0]=> "тушенка"

//---По ключам---
ksort($array[,method]);//ничего не возвращает, только сортирует
krsort($array[,method]);//ничего не возвращает, только сортирует



#------------------------Пользовательская сортировка----------------------
usort($array, cmp_function($val1, $val2));//сортирует по значениям ,пересоздаст все ключи(удалит существующие) 
uasort($array, cmp_function($val1, $val2));//сортирует по значениям с сохранением ключей, cmp_function($val1, $val2) - пользовательская функция сортировки
//ВАЖНО помнить, что пользовательская функция должна возвращить одно из 3х значений(-1,0,1). Если $val1<$val2 = -1, $val1=$val2 = 0, $val1>$val2 = 1, тоесть поочередно сравниваються все значения(по два) и меньшее переносится в первое положение в массиве а большее в последнее

$array = [15, 2, [8, 5], 7, [9, 15]];
uasort($array, function ($val1, $val2) {
    if (is_array($val1) && !is_array($val2)) return -1;//если 1 значение массив а 2 нет, то -1. т.е мы устанавливаем, что массив меньше обычного числа и все они будут расположены перед числами
    if (!is_array($val1) && is_array($val2)) return 1;//если 1 значение число, а второе массив, то 1. т.е мы решили что числа больше массивовб и они будут после них
    return $val1 <=> $val2;//сравниваем одинаковые типы в нормальном режиме $val1<$val2 = -1, $val1=$val2 = 0, $val1>$val2 = 1
});
/* 
интересно, как сравниваються массивы:
1. если массивы имеют одинаковое кол-во элементов [1,2] и [3,4], то они будут сравниваться по первой цифре стоящей в массиве, соотв [1,2] < [3,4], [5,1] > [2, 200]
2. если кол-во элементов внутри разное, то победит тот в котором больше элементов [1000, 200] < [1, 1, 1] 
*/

uksort(array, cmp_function($val1, $val2))// то же что и uasort, но сортирует по ключам


#-------------------------Переворачивание массива--------------------------
array_reverse($array); //меняет местами все в обратном порядке с сохранением связи с ключами [1,2,3]=[3,2,1]



#-------------------------Натуральная сортировка-----------------------------
$arr = [ 'img2', 'img1', 'img11', 'img21'];
echo asort($arr);   //['img1', 'img11', 'img2', 'img21'] отсортировал лексикографически, применить 
                    //цифровую нельзя, т.к. содержаться буквы
echo natsort($arr); //['img1', 'img2', 'img11', 'img21'] отсортировал по порядку и сохраняет связи 
                    //между ключами, прекрасно работает с кириллицей
natcasesort($arr);  //Не учитывает регистр символов

#-------------------------Сортировка списков---------------------------------
//данные функции игнорируют ключи(удаляют и присваивают заново)
sort($array [, SORT_STRING or SORT_NUMERIC]);//по значениям
usort(array, cmp_function($val1, $val2));//Сортирует с пользовательскими условиями
shuffle($array);//перемешивает значения пересоздавая ключи

#-------------------------Ключи и значения-----------------------------------
array_flip($arr);//возвращает копию массива где меняет местами ключ и значение, если есть 2 и более одинаковых значений, то меняет только 1 встретившийся экземпляр, а остальные пропускает
array_keys($arr);//возвращает список(нумерованный массив) с ключами массива $arr
array_values($arr);//возвращает список(нумерованный массив) с значениями массива $arr
array_count_values($arr);//возвращает список, в котором перечислены все значения массива и количество их повторов если таковые имеються
array_count_values([1,2,3,2,2,4,1]);//1=>2(1 встречаеться 2 раза), 2=>3(2 встречаеться 3 раза), 3=>1, 4=>1
array_change_key_case($arr, $case); //преобразует ключи в верхний или нижний регистр, $case = CASE_UPPER или CASE_LOWER

#-------------------------Слияние массивов-------------------------------------
$arr = ['a'=>'zz','b'=>'xx','c'=>'cc'];
$arr1 = ['e'=>'vv','f'=>'uu','b'=>'xxxx'];
//если встречаються два одинаковых ключа, то функция возмет чначение из правого и поместит на место такого же ключа в левом массиве, соотв если значения разные, то в первом масиве оно перезапишется на то что было в левом 'a'=>'zz','b'=>'xxxx','c'=>'cc','e'=>'zzz','f'=>'xxx'. Если же ключи цифровые, то значения из правого списка добавятся в левый и их ключи перезапишуться [0=>22,1=>33]+[0=>45]=[0=>22,1=>33,2=>45]
$new = array_merge($arr, $arr1);


#--------------------------Подмассивы-------------------------------------------
array_slice($array[ $offset, $length, $saveKey[bool] ]);//если не указан атрибут saveKey(по умолчанию false), то перезапишет ключи в возвращаемом массива
$arr = [0,1,2,3,4,5];
array_slice($arr, 3);//[3, 4, 5], а точнее[0 => 3, 1 => 4, 2 => 5]
array_slice($arr, 3, 2);//[3,4], а точнее[0 => 3, 1 => 4]
array_slice($arr, -2, 1);//[4]
array_slice($arr, -2, 2, true);//true сохранит ключи из исходного массива [4=>4, 5=>5]

array_splice($arr, $offset, $length, $replaceArr);// Удаляет часть массива и заменяет её чем-нибудь ещё(если указан 2 массив или строка) и возвращает удаленные элементы
array_splice([1,2,3,4,7,8], 2, [5,5]);//[0] => 1, [1] => 2,[2] => 5, [3] => 5, [4] => 7, [5] => 8


#---------------------------Добавление, удаление--------------------------
array_push($array, $var);//добавляет переменные в конец массива и возвращает количество элементов
array_pop($array);//удаляет последний элемент и возвращает его
array_unshift($array, $var);//добавляет переменные в начало массива и возвращает количество элементов
array_shift($array);//удаляет первый элемент и возвращает его

#---------------------------Переменные и массивы---------------------------
$name = "Max";
$surname = "Ostepan";
$sex = "men";
$profile = compact($name, $surname, $sex);//на выходе массив ["name"="Max","surname"="Ostepan","sex"="men"]
extract($profile); //Сосдаст переменные с ключами-именами и значениями, вобщем вернет все как было перед compact

#---------------------------Диапазон чисел-------------------------
$arr = range(1,100);//создаст массив от 1 до 100


#---------------------------Пересечение и разность-----------------
$arr1 = ['red','green','blue'];
$arr2 = ['pink','yellow','red', 'green'];
$inter = array_intersect($arr1, $arr2);//создаст массив ['red', 'green'] т.е пересекающиеся элементы
$diff = array_diff($arr1, $arr2);//создаст массив ['blue', 'pink', 'yellow'] т.е  не пересекающиеся элементы
$unic = array_unique($arr);//вернет массив из уникальных значений с их ключами, в вывод беруться первые встреченные элементы
$unic = array_unique(array_merge($arr1, $arr2));//сначала сольет 2 массива как есть, а потом вернет массив без дублирующихся значений 'red','green','blue','pink','yellow'

#-------------------------JSON-------------------------------------
$arr = [
    "hello bro" => "hi",
    "Хмырь" => "Здарова"
];
print_r(json_encode($arr, JSON_UNESCAPED_UNICODE));// { "hello br's" : "hi" , "Хмырь" : "Здарова" }
//кодирует массив в JSON формат, но при использовании кирилицы необходимо использовать параметр JSON_UNESCAPED_UNICODE, что бы PHP не кодировал кириллицу, а использовал как есть, т.к. JS прекрасно работает с UTF8
json_decode($json); //преобразует все обратно