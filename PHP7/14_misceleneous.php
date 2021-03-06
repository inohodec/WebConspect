<?php 
//=====================INFO=========================
phpinfo(); //настройки программыб переменные окружения и многое другое
phpversion();//версия php
getlastmod();//последнее изменение текущего файла-сценария(не включает include и т.п.)

//=====================EXIT==========================
exit();//завершает сценарий вызывая финализаторы
die('message');//завершает сценарий вызывая финализаторы и печатая строку 


//=====================Финализаторы=======================
/*
Это простая функция выполняемая при завершении сценария(неважно из-за ошибки или окончания)
мы можем делать запись в лог файл или т.п. В линукс она вызывается после закрытия соединения с браузером и echo ничего не выведет на экран, в винде все ок. Для создания финализатора имя функции надо передать встроенной функции register_shutdown_function (FuncName()); , можно создавать несколько финализаторов, но register_shutdown_function должна быть выполнена до окончания скрипта или перед die()/exit()
*/
register_shutdown_function (logFile());
die("I'M DEAD");

function logFile() {
    $lf = fopen ('log.txt', 'a+b');
    flock ($lf, LOCK_EX);
    fwrite ($lf, "Some New Message\n");
    fclose ($lf);
}

//===================Выполнение кода========================
eval(code_str);//выполняет код в кавычках, если он возвращает значение с помощью return, то возвращает его тоже. Не забываем про кавычки, ведь используя "" знак $ будет интерполироваться в переменную, а данная функция использует все существующие переменные данного скрипта. Подробнее в доках или ст. 416
eval('$str = \'message\'');
eval("\$str = 'message'");

//Аналог include, считает код из файла и "вставит"" его в текущий файл.
$code = file_get_contents('user.php', true);
eval("?>$code<?php");
//создание 20 функций и их вывод
for ($i = 0; $i < 20; $i++) {
    eval("function printSquad$i() {echo $i * $i;echo'<br>';} usleep(2000000); printSquad$i();");
}


//==================PAUSE=======================================
usleep(micro_seconds);
