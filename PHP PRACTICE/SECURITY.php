<?php

$srting = "<div><p>Hello <span><b>Bro 'my'<b><span> </p><p>Wat's up</p></div>";
$new_string = strip_tags($string);
//преобразует строку в Hello Bro 'my' Wat's up
$new_string = strip_tags($string, '<p><span>');
//преобразует строку в <p>Hello <span>Bro 'my'</span></p><p>Wat's up</p>



$string = "<p>Hello Bro 'my' </p><p>Wat's up</p>";
$new_string = htmlentities($string);
//преобразует строку в &lt;p&gt;Hello Bro 'my' &lt;/p&gt;&lt;p&gt;Wat's up&lt;/p&gt;
//соответственно удалив все спецсимволы, так же функция принимает параметры
echo $new_string . "<br>";
$decode_string = html_entity_decode($new_string);
//раскодирует строку обратно в HTML, так же принимает параметры,
//если закодировали с конкретным параметром, то и раскодировать нужно с ним же
echo $decode_string . "<hr>";

if (get_magic_quotes_gpc())
    echo "Quotes is running";
//проверяет включены ли волшебные кавычки и если да, то отменяет их в $string
else {
    $string = stripslashes($string);
    echo 'Quotes is off';
}
echo "<hr>";


/* Полное обезвреживание данных */

// 1 - правильно читать со 2ой функции  desinfection_inner
// она принимает объект подключения к БД и строку(например из $_POST)
//проверяет волшебные кавычки и если они есть то отключает их
//далее использует real_escape_string для обеззараживания данных для вставки в SQL,
//потом возвращает desinfection значения, которую та в свою очередь обеззараживает от HTML кода
function desinfection($conn, $value) {
    return htmlentities(desinfection_inner($conn, $value));
}

function desinfection_inner($conn, $value) {
    if (get_magic_quotes_gpc()) $value = stripcslashes($value);
    return $conn->real_escape_string($value);
}
