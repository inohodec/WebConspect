<?php

/* 
 * usefull tricks and shugar
 */

//spaceship return $a <=> $b
//возвращает 1, -1 или 0 в зависимости от того, как соотносятся его операнды

3 <=> 5; // -1 (выражение слева от оператора "<=>" меньше выражения справа)
5 <=> 5; // 0 (выражения слева и справа равны)
5 <=> 3; // 1 (выражение слева больше выражения справа)

$users = [
      ['name' => 'Danil', 'age' => 1],
      ['name' => 'Vovan', 'age' => 4],
      ['name' => 'Matvey', 'age' => 16],
      ['name' => 'Igor', 'age' => 19],
    ];

$cmp = fn($a, $b) => $a['age'] <=> $b['age'];

usort($users, $cmp);
