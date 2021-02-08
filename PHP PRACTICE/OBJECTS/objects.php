<?php
echo '<pre>';
class book_shop {
    //свойства объекта (переменные) если объявлены без значений, то можно указать позже $shop->name = "Туту";
    public $name;
    public $city;
    public $class = 'Universal Book Shop';
    //в константах и переменных храним свойства относящиеся ко всему классу
    const STATUS = "Awesome Shop";
    static $header = "WELCOME to: ";
    //конструктор выполняеться при создании объекта, так же мы добавили значения по умолчанию если параметры не будут указаны
    public function __construct($name = "Somebody's Shop", $city = 'Unknown') {
        //обращение внутри объекта к его свойствам делаем с помощью $this
        $this->name = $name;
        $this->city = $city;
    }
    public function location($country = "Unknown") {
        //обращение к константам или стачическим свойствам делаем через self::
        //и не забываем что $this обращается к значению объекта, а self:: самого класса
        $address = "<b>".self::$header."an <b><i> ".self::STATUS." - </i>$this->name $this->city $this->class $country";
        return $address;
    }
    //деструктор выполняеться при удалении объекта или окончании работы скрипта
    public function __destruct() {
        echo 'Object was deleted';
        
    }
}
//создаем объекты с параметрами и без
$shop = new book_shop('Dnepr', "Max's Shop");
$new_shop = new book_shop('Belickoe',"Lena's Shop");
$empty_shop = new book_shop();

print_r($shop);
print_r($new_shop);
print_r($empty_shop);
//вызываем методы объекта с параметрами и без
echo "<hr>".$shop->location('Ukraine')."<hr>";
echo $new_shop->location('Russia')."<hr>";
echo $empty_shop->location()."<hr>";
