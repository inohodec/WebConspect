<?php

/* 
 * Функция считаеться детерменированной если при одних и тех же входных аргументах
 * возвращает одно и то же значение.
 */
$x = 5;
function getNumberDet($x)
{
    return $x . 5;       //детерменированная
}

function getNumberNonDet($x)
{
    return $x . $_POST['y'];       //недетерменированная
}

random_int(0, 20);                 //недетерменированная
//
//Функция становится недетерминированной и в том случае, если она обращается не только к своим аргументам, 
//но и некоторым внешним данным, например глобальным переменным, переменным окружения и так далее. 
//Так происходит потому, что внешние данные могут измениться, и функция начнёт выдавать другой результат 
//даже если в неё передаются одни и те же аргументы.
