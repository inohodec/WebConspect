<?php
/************************************ФУНКЦИИ и ОБЛАСТИ ВИДИМОСТИ***********************************************/

#----Аргументы функций
/*
Когда мы передаем какой либо параметр функции, то на самом деле создается копия переменной которую мы 
указываем в аргументах функции при вызове и все действия происходят с копией(пример 1). Для того, 
что бы изменить переменную в действительности, необходимо передать ее по ссылке как в примере 2 либо же 
указать параметр global(пример 3)
*/
$a = 10;

//--------пример1
function increment1($value)
{
	$a++;
	echo a;             
}
increment($a);          //выведет 11
echo $a;                //выведет 10

//---------пример2
function increment2(&$a)
{
    $a++;
    echo $a;
}

increment($a);          //выведет 11
echo $a;                //выведет 11


#---------Множественные аргументы(неизвестное количество)---------
//Есть два способа передать аргументы, если их кол-во неизвестно

//способ 1 - использовать пустые скобки и встроенный набор функция для управления

function myCars() {
    for ($i = 0; $i < func_num_args(); $i++) { //func_num_args() - получает кол-во аргументов у функции
        echo func_get_arg($i)."<br>"; //func_get_arg($index) - получает значения аргумента с индексом $index(начинается с 0)
    }
}
myCars("BMW", "Audi", "Volvo");
//способ 1(foreeach)
function myCars() {
    foreach (func_get_args() as $value) {
    	echo $value."<br>";
    }
}
myCars("BMW", "Audi", "Volvo");


//Способ 2 доступен начиная с версии 5.6
function myCars(...$cars) { //массив состоящий из аргументов
    foreach ($cars as $value) {
    	echo $value."<br>";
    }
    echo sizeof($cars);//выведет 3 (кол-во элементов массива)
    echo $cars[2];//выведет Volvo
}
myCars("BMW", "Audi", "Volvo");

//так же можно использовать в таком ключе:
function ourCars($myCar, $wifeCar)
{
    echo "my car is: ".$myCar." wife's car is: ".$wifeCar;
}
$cars = ["BMW", "Audi"];
ourCars(...$cars);//передаем наш массив как массив аргументов функции.



#------------------$GLOBALS-----------------------------------
//массив содержит все текущие глобальные переменные, его использование допустимо в ЛЮБОМ месте скрипта
$GLOBALS['message'] = "Hello World!";
//равносильно
$message = "Hello World!";
//пример 1
function changeMessage ()
{
	$GLOBALS['message'] = "Bye bye World!";
}
changeMessage(); //изменит глобальноу переменную $message с "Hello World!" на "Bye bye World!"

//пример 2 - выведет "привет"
$string = ['привет', 123, 'gdfgdf'];
var_export($GLOBALS['string'][0]);

//ВАЖНО!!! - 1) массив $GLOBALS нельза присвоить переменной, т.е. $a = $GLOBALS;
//ВАЖНО!!! - 2) переменную массива $GLOBALS нельза передать функции по значению, только по ссылке;

$a = 100;
function globals() {
	global $a;//идентично с $a = &$GLOBALS['a'], т.е. создает внутри функции ссылку на глобальную переменную
	$a = 200; //передаст значение по локальной переменной(ссылке) $a глобальной переменной $a 
	unset($a);//удаляет не глобальную переменную $a ,а ссылку созданную на нее внутри функции
}
globals();
echo $a = 200;

#----------------------------статические переменные----------------------------
//Может быть объявлена только внутри функции. Она сохраняет своё значение при последующих запусках функции
function loop() {
    static $count = 0;
	$count++;
	echo $count."<br>";
}
for ($i = 0; $i < 5; $i++) loop();



#----------------------Условно определяемые функции-------------------
if (PHP_OS == 'Linux') {
	function createFile() {
		$file = `touch newFile.txt`;//создает файл в каталоге скрипта
	}
} elseif (PHP_OS == 'Windows') {
	function createFile() {
		$file = `echo > newFile.txt`;
	}
}


#---------------------Анонимные функции--------------------------
$myCars = function (...$cars) {
	echo "I have ". count($cars). " cars: ";
	foreach ($cars as $model) {
		echo " $model ";
	}
};
$myCars("RENO","BMW","Audi");

#--------------------Замыкания-----------------------------------
//делаеться с помощью "use", т.е. мы захватываем значение переменной в данный момент и никакие изменения глобальной переменной не повлияют на копию которую мы используем в функции 
$message = "I can't continue because of errors";
$alert = function ($errors) use ($message)
{
    echo "$message : $errors";
};
$message = "I need components";//мы изменили глобальную переменную, но при вызове функции выведеться та, которую мы захватили изначально
$alert('php, mySql');//вывод - I can't continue because of errors : php, mySql
//важно понимать, что  если мы переопределим "$message" до объявления функции, то конечно же её значение измениться и мы получим : "I need components : php, mySql"

#-------------------Передача функции внутрь другой функции--------------------
//Если функции объявленны в теле скрипта, то они соответственно будут доступны в любой точке кода, например внутри других функций:
function asd() {
    $x = 15;
    echo dsa($x);
}
function dsa($value) {
    $value += $value;
    return $value;
}
asd(); //выведет 30

//Но если вдруг нам необходимо передать функцию как аргумент и не как анонимную, то делаем так:
function asd($varHandler) {
    $x = 15;
    echo $varHandler($x);
}
function dsa($value) {
    $value += $value;
    return $value;
}
asd('dsa'); //выведет 30
//Если указать аргумент без кавычек по типу dsa(), то будет ошибка отсутствующего аргумента функции dsa.

#=====================Еще вариант выполнения функции============================
function printData() {
    echo "string";
}
$a = 'print';
$a(); //выведет 