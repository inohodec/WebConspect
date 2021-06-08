<?php

/* 
 * Каждая функция, в своем теле, задает так называемую область видимости. 
 * Внутри этой области доступны только те переменные, которые были определены там же. 
 * Переменные определённые вне функции, не видимы внутри неё.
 * Но передача аргументов все же возможна, и делается она благодаря "замыканию". 
 * 
 * С помощью этого механизма можно "захватить" переменные из внешнего окружения 
 * и использовать их внутри. Правда, только для анонимных функций. Термином "замыкание" 
 * нередко называют и саму функцию, которая осуществила захват внешних переменных.
 * 
 * Захват переменных осуществляется с помощью ключевого слова use и списка переменных, 
 * который идёт после этого слова. Крайне важно осознать, что use используется при определении функции, 
 * а не её вызове.
 */

$generate = function () use ($age) {
    print_r($age);
};

//an example

function without(array $items, $value)
{
    $filtered = array_filter($items, function ($item) use ($value) {
        return $item !== $value;
    });
    // Сбрасываем ключи
    return array_values($filtered);
}

without([3, 4, 10, 4, 'true'], 4); // [3, 10, 'true']

//можно использовать стрелочные функции т.к. они имеют доступ у глобальной области видимости

function without(array $items, $value)
{
    $filtered = array_filter($items, fn($item) => $item !== $value);
    // Сбрасываем ключи
    return array_values($filtered);
}