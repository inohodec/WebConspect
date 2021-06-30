<?php
// Правильно:
declare(ticks=1);

function foo(int $val, bool $decision)
{
    if ($decision) {    
        var_dump($decision);    
    }
}

foo(5, "false");    //в данном случае будет ошибка, из-за неверного типа, но если не указать declare(ticks=1);
                    //то строка "false" преобразуесть в true, лубая не пустая строка будет преобразована в true
