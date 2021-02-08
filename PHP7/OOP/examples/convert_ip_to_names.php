<?php

//Класс принимает любое кол-во ip адресов и выводит для них доменные имена если таковые существуют или же сами адреса в ином случае.  

class Ip_to_name
{
    private $addr = [];//массив с адресами

    //принимаем любое количество адресов
    public function __construct(...$ip)
    {
        if (empty($ip)) die ("You havn't entered any ip's");//если массив пуст то завершаем скрипт
        $checking = $this->check_ip($ip);//запускаем проверку на соотв. шаблонам iP
        if ($checking) { //если пройдена проверка, то запускаем запись адресов в массив и печатаем результат
            $this->write_ip($ip);
            $this->print_ip ();
        }
        else die("One or more IP adresses have the wrong format!");
    }
//записывает данные в массив $addr
    private function write_ip(array $ip) {
        foreach ($ip as $index => $address) {
            $this->addr[] = [$address, gethostbyaddr ($address)];
        }
    }
//проверяет полученные значения на соответствия шаблону адресов если все ок, возвращает true иначе false
    private function check_ip(array $ip) {
        foreach ($ip as $address) {
            $address = trim ($address);
            $isIP = preg_match ("/^\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}$/", $address);
            if (!$isIP) {
                return false;
            }
        }
        return true;
    }
//Печатает массив с нашими адресами
    private function print_ip()
    {
        foreach ($this->addr as $index=>$value) {

            echo ($index+1)." ip: ".$value[0]."; has name - ".$value[1]."<br>";
        }
    }
}

$names = new Ip_to_name("91.234.35.40", "f62.105.149.64");
?>