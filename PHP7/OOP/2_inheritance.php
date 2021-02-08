<?php
/*
создаем универсальный класс с продуктами ShopProduct, далее расширяем его 2мя дочерними классами CDPoduct
и BookProduct котрые наследуют все свойства и методы суперкласса ShopProduct и добавляет свои собственные
getSummaryLine() для печати в счете фактуре к примеру.
ВАЖНО!!! Если в дочернем классе объявить метод или свойство с таким же именем как и в родительском,
то будет использован новый объявленный метод или свойство. К примеру в коде суперкласса есть метод getProd() возвращающий имя "создателя" товара, если его изменить в CDPoduct, то при вызове данного метода из объекта класса CDPoduct использует новый созданный нами метод(т.е. он как бы перезапишеться для класса CDPoduct), а если вызвать его из объекта класса BookProduct, то будет использован метод суперкласса ShopProduct.
Короче говоря, интерпретатор вначале ищет метод или св-тво в контексте класса ,
к которому принадлежит объект и если не находит то начинает поиск в родительском. echo $book->getProd (); -
интерпретатор ищет метод в классе BookProduct и не находит его, поэтому он подымается в класс ShopProduct ищет его там, соотв. находит и выполняет.
*/
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
    private $type = "CD";
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
        $base = parent::getSummaryLine(); //вызываем родительскую функцию
        $base .= ": Sound Time - {$this->playLength}<br>";
        return $base;
    }
}

//класс для книг наследует и расширяет класс ShopProduct
class BookProduct extends ShopProduct {
    private $type = "CD";
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
        $base = parent::getSummaryLine(); //вызываем родительскую функцию
        $base .= ": Pages - {$this->numPages}<br>";
        return $base;
    }
}

$cd = new CDPoduct("X Factor", "Band", "Iron Maiden", 20.55, 127);
echo $cd->getSummaryLine ();
$book = new BookProduct("Mobi Dick", "Author", "Pushkin", 36.25, 356);
echo $book->getSummaryLine ();


/*************************** Наследование (конструкторы и функции)  ************************************/
/*
При определениии конструктора в дочернем классе, мы берем на себя ответственность(т.е. мы должны передать), за передачу аргументов родительскому классу, если же этого не сделать, то объект будет сконструирован не полностью(т.е. констуктор родителя не получит данных и не выполнится).
Важно понимать, что если мы объявили конструктор в суперклассе и в наследуемом классе, то конструктор из родителя не выполнится и если он нам нужен, тогда нужно вызывать его из класса который его наследует.
Соответсвенно, если нам нужно вызвать метод класса родителя, но мы его переназначили, то используем ключевое слово parent:: (parent::someMethod, parent::__construct). Пример с кодом представленным выше находится в папке examples 
*/
class Father {
    protected $val = [];
    function __construct(...$items)//принимает некоторое количество значений и печатает их
    {
        foreach ($items as $val) {
            $this->val[] = $val;//закидываем значения в массив
        }
        print_r($this->val);//выводим массив
        echo "<br><hr>";
    }
}
class Son extends Father {
    private $whoIs;
    function __construct($whoIs ,...$items) //принимает имя(к примеру отца) и некоторое кол-во значений печатая их
    {
        parent::__construct(...$items);//передаем массив значений в родительский конструктор
        $this->whoIs = $whoIs;
        echo "--==".$whoIs."==--";//печатаем имя
    }
}

$a = new Father("Buy Buy", "Aloha");
$b = new Son("It is Max", "Покеда", "Нello");
/*каждый дочерний класс вызывает конструктор своего родительского класса, прежде чем определять собственные свойства. Базовый класс теперь "знает" только о собственных данных($items но не $whoIs). Дочерние классы - это обычно "специализации" родитель­ских классов. Как правило, следует избегать того. чтобы давать родительским клас­сам какие-либо особые "знания" о дочерних классах.



ВАЖНО!!!:
Видимость из других объектов 

Объекты, которые имеют общий тип (наследуются от одного класса), имеют доступ к элементам с модификаторами private и protected друг друга, даже если не являются одним и тем же экземпляром. Это объясняется тем, что реализация видимости элементов известна внутри этих объектов.
*/

class Base
{   //Для наглядности все свойства, имена и значения совпадают
    public $public = "public"; //Доступ отовсюду
    protected $protected = "protected";//Доступ изнутри объектов класса и объектов классов потомков
    private $private = "private";//Доступ ТОЛЬКО изнутри объектов класса

    public function getOwnVal() //выводит значения свойств класса
    {
        echo $this->public."; ";
        echo $this->protected."; ";
        echo $this->private." (from class: ".__CLASS__.")<hr>";
    }
}
class Branch extends Base
{
    private $private = "private (from class: ".__CLASS__.")<hr>";// НЕ "перезапишет" значение в Base

    public function getBaseVal(Base $obj)
    {   // Выводит значение свойств объектов класса Base
        echo $obj->public."; ";
        echo $obj->protected."; ";
        echo $obj->private." ".__CLASS__."<hr>";// Не сработает т.к. доступ к private из подкласса запрещен
    }

    public function getPrivate()
    {
        echo $this->private; // Выведет значения переменной принадлежащей текущему классу Branch
    }
}
class BranchNew extends Base
{
    public $public = "public (from class: ".__CLASS__.")";// "Перезапишет" значение в Base
    protected $protected = "protected (from class: ".__CLASS__.")";// "Перезапишет" значение в Base
    private $private = "private (from class: ".__CLASS__.")<hr>";// НЕ сможет "перезаписать" значение в Base

    public function getPrivate()
    {
        echo $this->private; // Выведет значения переменной принадлежащей текущему классу BranchNew
    }
}

$obj1 = new Base();
$obj2 = new Branch();
$obj3 = new BranchNew();

$obj1->getOwnVal ();
// public; protected; private (from class: Base) - выводит всё, т.к. получаем доступ из объекта принадлежащего Base
$obj2->getOwnVal ();
// public; protected; private (from class: Base) - как ни странно, получаем то же, из за того что интерпретатор ищет данный метод getOwnVal() в классе Branch, но т.к. он его не находит и Branch наследует Base, то интерпретатор перемещается в родительский класс(Base), находит метод getOwnVal() и выполняет его. Естественно что он извлекает значения переменных текущего класса(Base) в котором содержится метод getOwnVal
$obj2->getPrivate ();
// private (from class: Branch) - т.к. данный метод пренадлежит классу Branch, то он возьмет значение $privat из текущего класса
$obj3->getOwnVal ();
// public (from class: BranchNew); protected (from class: BranchNew); private (from class: Base) - т.к.
// возьмет значания переменных $public, $protected из текущего класса(BranchNew) из-за того, что мы переназначили все переменные внутри текущего класса, хоть метод getOwnVal() и принадлежит родительскому классу Base, интерпретатор возьмет 2 значения из текущего класса BranchNew, а 3-ье значение из класса Base т.к. переменные и методы private переназначить извне или класса потомка нельзя
$obj3->getPrivate ();
// private (from class: BranchNew) - т.к. данный метод пренадлежит классу BranchNew,
// то он возьмет значение $privat из текущего класса
$obj2->getBaseVal ($obj1);
//public; protected; Fatal error: - ошибка из-за того что мы пытаемся получить доступ к переменной со св-вом
// private из объекта принадлежащего классу потомку



