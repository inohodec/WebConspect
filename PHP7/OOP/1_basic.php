<?php 
/**************Объявление класса***************/

class Library {//объявляем класс
	public $name, $address;//инициализируем переменные
	function __construct($name = "Unknown", $address = "Unknown")//выполняеться при инициализации объекта
    {
    	//инициализация принятых переменных или значение по умолчанию "Unknown"
        $this->name = $name;
        $this->address = $address;
    }
    //печатает имя и адрес библиотеки
    function printInfo()
    {
        echo "Library: {$this->name}<br>Add: {$this->address}<br>";
    }
    //выполняется при завершении работы объекта
    function __destruct()
    {
        echo "<br>Object is DEAD";
    }
}
$newLibr = new Library("Max lib", "It still builded");//инициализация объекта $newLibr класса Library
$newLibr->printInfo();//вывод адреса


/**************Уточнения типов объекта*******************/
//Строгая типизация работает только с классами, для базовых типов нужно использовать is_bool и т.д.

class CheckerIP {
    private $ip;
    function __construct($ip)//принимаем ip адрес
    {
        $this->ip = $ip;
    }
    //проверяем адрес на соответствие шаблону, если ок, то оставляем как есть, или возвращаем ошибку
    public function returnIP() {
        $result = preg_match ("/^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$/", $this->ip);
        $this->ip = $result ? $this->ip : "The number is wrong";
        return $this->ip;
    }
}

class WritrIP {
    public function __construct(CheckerIP $ip)//разрешаем передавать внутрь только объекты класса CheckerIP
    {
        echo $ip->returnIP();//печатаем адрес или ошибку
    }
}

$ip = "192.168.1.2";
$newIP = new CheckerIP($ip);
$output  = new WritrIP($newIP);