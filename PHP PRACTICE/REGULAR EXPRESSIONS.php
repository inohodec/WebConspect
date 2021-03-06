<?php

$string = "Students I'm really a good student. I'm gonna finish my studying in 2017 and find a new job by 2019 aZ-4356CC";
$pattern = '/student/';

/* ВАЖНО!!! ищет не отдельно стоящие символы а указанную комбинацию в составе всей строки
  т.е. если мы ищем "23" , а у нас есть запись "ПН-23УА" - это будет считаться совпадением */
$result = preg_match($pattern, $string);
var_dump($result); //выдаст int(1) если найдет хоть одно совпадение или int(0 если его нет)

$pattern = '/201[0-5]/'; //будет искать совпадение от 2010 до 2015

$pattern = '/201[1-3,5,6]/'; //будет искать совпадение с 2011 по 2013 и 2015 с 2016 годами
$pattern = '/[0-9][0-9][0-9]/'; //будет искать совпадение с 2011 по 2013 и 2015 с 2016 годами


$pattern = '/p{3}/'; //будет искать символы "p" в количестве 3штук стоящих подряд
$pattern = '/p{3,6}/'; //будет искать символы "p" в количестве от 3х до 6ти штук стоящих подряд
$pattern = '/p{3,}/'; //будет искать символы "p" в количестве от 3х до бесконечности штук
$pattern = '/[aA-zZ]{2}-[0-9]{4}[A-Z]{2}/'; //будет искать строку типа "hZ-4567DD"

$n = preg_match("/c[aeo]ts/i", "Cats are fun. I like cats.", $match);//$match это массив в первый индекс которого помещаеться найденное совпадение, сама переменная может иметь только два значения 1(true) если есть совпадение или 0(false) если совпадения нет 
echo $match[0];//выведет Cats(первое совпадение)

/*------------Множественный поиск-----------------------*/
$n = preg_match_all("/cats/i", "Cats are fun. I like cats.", $match);//значение $n будет зависеть от количества совпадений, т.е. от 0(если совпадений нет) и более, найденные соответствия помещаються в подмассив $match[0][*] - где (*) индекс элемента
for ($i=0; $i < $n; $i++) {
    echo "Совпадение номер ".($i+1)." - ".$match[0][$i]."\n";
}
/*Вывод :
Совпадение номер 1 - Cats
Совпадение номер 2 - cats
*/
echo preg_replace("/cats/i", "dogs", "Cats are fun. I like cats.");//заменит cats на dogs