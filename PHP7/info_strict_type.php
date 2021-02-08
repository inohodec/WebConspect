<?php
declare(strict_types=1);//включаем строгую типизацию

function sum(int $a, int $b) {
    return $a + $b;
}

var_dump(sum(1, 2));//выдаст 3
var_dump(sum(1.5, 2.5));//выдаст ошибку

/**************Без строгой типизации*********************/
function sum(int $a, int $b) {
    return $a + $b;
}

var_dump(sum(1, 2));//выдаст 3
var_dump(sum(1.5, 2.5));//выдаст 3 (округлит значения т.к. они у нас integer)