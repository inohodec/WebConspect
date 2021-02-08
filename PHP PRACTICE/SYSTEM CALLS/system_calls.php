<?php
$cmd = "dir"; //команда которую мы выполним в терминале или командной строке
//exec выполняет команду и присваевает результат вывода переменной $output
//$status принимает значение 0(FALSE) если ошибки нет и 1(TRUE) если она есть
//escapeshellcmd($cmd) запрещает появление окна командной строки и выполняет команду в "фоне"
exec(escapeshellcmd($cmd), $output, $status);
if ($status)    echo "Command didn't execute";
else {
    echo "<pre>";
    foreach ($output as $value) {
       echo htmlspecialchars("$value\n");
    }
}