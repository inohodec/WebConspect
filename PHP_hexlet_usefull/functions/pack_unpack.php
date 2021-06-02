<?php

/* 
 * при объявлении функции происходит упаковка аргументов в мвссив
 */

function pack(int ...$params) {     //pack(array [int $a, int $b[, ...]])
    foreach ($params as $param) {
        echo $param . PHP_EOL;
    }
}

pack(3, 5, 6, 4);       //превратиться в pack(array [int 3, int 5, int 6, int 4])

/* 
 * при вызове функции происходит распаковка аэлементов из массива
 */

function sum(int ...$numbs)
{
    return array_sum($numbs);
}

$arr = [2, 3, 6, 15];
//если вызвать sum($arr), то по сути это равно sum([ [2, 3, 6, 15] ])
//по сути ...$variable распаковывает массив [[1, 2], 3, [4, 5]] => [1, 2], 3, [4, 5]

$sum = sum(...$arr);    //sum([2, 3, 6, 15]) если вкинуть массив
