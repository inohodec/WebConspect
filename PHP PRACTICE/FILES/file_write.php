<?php
require_once 'just_form.php'; //добавляем форму

/*если в массиве POST есть данные и они не пустые то выполняем код*/
if (isset($_POST['text']) && !empty($_POST['text'])) {
    //обеззараживаем значение POST
    $message = htmlentities($_POST['text']);
    //Открываем файл log.txt в режиме записи в конец файла
    $entry = fopen('log.txt', 'a');
    //если открытие удачно то блокируем файл, делаем запись и разблокируем обратно
    if (!$entry) echo "There is some problem with log file";
    else {
        flock($entry, LOCK_EX);
        fwrite($entry, $message."\n");
        flock($entry, LOCK_UN);
    }
}
//Если файл существует, то сообщаем об этом и выводим его содержимое
//Если нет то говорим, что файл отсутствует
if (file_exists('log.txt')) {
    echo "<p>File 'log.txt' Exists</p>";
    echo "<pre>".file_get_contents('log.txt')."<pre>";//выводит все содержимое файла
    
}
else    echo "</p>File 'log.txt' doesn't exist</p>";

//удалить файл можно 
unlink('test.html');






