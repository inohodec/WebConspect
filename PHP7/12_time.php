<?php
//=================================TIME=================================

//проверяем date.timezone в php.ini или смотрим с помощью phpinfo(),echo date_default_timezone_get (); и если оно отлично от киева меняем в php.ini или  date_default_timezone_set("Europe/Kiev"); в начале каждого скрипта
time();//выводит кол-во секунд от 01.01.1970
microtime(true);////выводит кол-во секунд с данными после точки от 01.01.1970, если не указан параметр true то выводит дробную и целую чвсти отдельно


//Выводит время исполнение скрипта
define ("START_TIME", microtime (true));//берем текущий момент
echo "Checking speed";
printf ("Script time is: %.7f s", microtime (true) - START_TIME);//берем "сейчас" и отнимаем от него константу(время начала скрипта)


#--------------------------------ДАТА-------------------------------------
date(format, timestamp);//формат смотрим доки, а второй параметр это число прошедшее с 1.1.1970, которое преобразуется в норм дату, если оно отсутствует, то берется текущий момент 

date("file was created: d-m-Y at H:i:s", filectime(__FILE__));
//проблема в том что многие англ символы функция видит как параметр и отображает кучу всего, этой функцией удобно пользоваться когда не нужно выводить еще и текст
echo date("d-m-Y H:i:s", filectime(__FILE__));//11-10-2017 15:30:01

echo strftime ("%d:%m:%Y at %H:%M", filectime(__FILE__));//11:10:2017 at 15:30, т.е. выводит время как строку

mktime();//преобразует норм дату в timestamp
echo mktime(0,0,0,12,31,2004);//1104530400