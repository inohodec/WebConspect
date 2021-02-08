<?php
$array = array('one', 'two', 'three','four', array(2,1,3));
//считаем элементы массива
echo count($array).'<br>'; //выведет 5, т.к. считает элементы массива 1го уровня
echo count($array, 1).'<br>'; //выведет 8, т.к. считает все элементы массива
//--------------------------------------------------
$array = array(5, 0, 8, 1);
sort($array);//отсортирует массив в порядке возрастания rsort - убывания
print_r($array); 

shuffle($array); //перемешает массив
print_r($array);
echo '<hr>';

//----------------------------------------------
//Создаст из строки массив где значениями будут части разделенные символом в кавычках
//Array ( [0] => Countries [1] => Cyties [2] => Towns [3] => Vilages ) 
$new_array = explode('_', "Countries_Cyties_Towns_Vilages");
print_r($new_array);
echo '<br>';
//------------------------------------------------------------
//используют с GET/POST - создает автоматом переменные с именем
//ключа массива пост или гет + приставку с подчеркиванием
// в данном случае quiz
$_POST['name'] = 'Bill';
$_POST['action'] = 'KILL';
$_POST['expectations'] = 'I hope';

extract($_POST, EXTR_PREFIX_ALL, 'quiz');
echo "$quiz_expectations $quiz_action $quiz_name";//вывод I hope KILL Bill
echo '<hr>';
//----------------------------------

//создаст ассоциативный массив с ключами-переменными и значениями-значениями переменных 
$name = 'Max';
$surname = 'Ostepan';
$age = '33';

$person = compact('age', 'name', 'surname');//пишем переменные в кавычках и без знака $
print_r($person);//вывод  [age] => 33 [name] => Max [surname] => Ostepan
echo '<br>';
print_r(compact(explode(' ', 'age name surname'))); //используют для отладки
//===========================

