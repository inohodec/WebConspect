<?php 

echo fileowner('counter.txt');          //вернет ID владельца
echo filegroup('counter.txt');          //вернет ID группы
chmod('counter.txt', 0777);             //меняет доступ к файлу

fileperms('counter.txt');               //вернет права в закодированном виде
$perms = fileperms('counter')."<br>";
echo decoct ($perms)."<br>";            //8-ричная система, последние 3 цифры - права 100777
echo decbin ($perms);                   //2-ичная система, первые 7 цифр - тип файла книга 350 ст. подробнее

stat($filename);                        //Возвращает массив со всей известной информацией о файле