<?php
class ShopProduct {
    public $title;
    public $prodMainName;
    public $prodFirstName;
    public $price;
    //присваеваем полученные данные переменным
    function __construct($title, $firstName, $mainName, $price)
    {
        $this->title = $title;
        $this->prodFirstName = $firstName;
        $this->prodMainName = $mainName;
        $this->price = $price;
    }
    //возвращает имя "создателя" товара
    function getProd() {
        return "{$this->prodFirstName} {$this->prodMainName}";
    }
    //возвращает базовую строку для счета фактуры, которая присутствует во СВЕХ товарах независимо от типа
    function getSummaryLine() {
        $base = "{$this->title} ( {$this->prodFirstName}, {$this->prodMainName} )";
        return $base;
    }
}

//класс для CD дисков наследует и расширяет класс ShopProduct
class CDPoduct extends ShopProduct {
    private $playLength;

    function __construct($title, $firstName, $mainName, $price, $playLength) {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->playLength = $playLength;
    }
    //длинна записи
    function getPlayLenght() {
        return $this->playLength;
    }
    //ПОЛНАЯ СЧЕТ ФАКТУРА включающая базовую getBaseLine() и текущую строки товара
    function getSummaryLine()
    {
        $base = parent::getSummaryLine();
        $base .= ": Sound Time - {$this->playLength}<br>";
        return $base;
    }
}

//класс для книг наследует и расширяет класс ShopProduct
class BookProduct extends ShopProduct {
    private $numPages;
    
    function __construct($title, $firstName, $mainName, $price, $numPages) {
        parent::__construct($title, $firstName, $mainName, $price);
        $this->numPages = $numPages;
    }
    //длинна книги
    public function getNumPages(): int
    {
        return $this->numPages;
    }
    //ПОЛНАЯ СЧЕТ ФАКТУРА включающая базовую getBaseLine() и текущую строки товара
    function getSummaryLine(): string
    {
        $base = parent::getSummaryLine();
        $base .= ": Pages - {$this->numPages}<br>";
        return $base;
    }
}

$cd = new CDPoduct("X Factor", "Band", "Iron Maiden", 20.55, 127);
echo $cd->getSummaryLine ();
$book = new BookProduct("Mobi Dick", "Author", "Pushkin", 36.25, 356);
echo $book->getSummaryLine ();