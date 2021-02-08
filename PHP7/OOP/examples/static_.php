<?php

class Purchaise
{
    private static $offer = 0;//Наша скидка
    private $price;//Наша цена
    //Устанавливает размер скидки
    static function setOffer(int $offer)
    {
        self::$offer = $offer;
    }
    //устанавливает цену
    public function setPrice($price)
    {
        $this->price = $price;
    }
    //получает установленную нами цену
    function getPrice()
    {
        return $this->price;
    }
    //получает цену с учетом скидки
    function getTotalPrice()
    {
        return $this->price - self::$offer;
    }


}

class Item extends Purchaise
{
    //some code...
}
//создаем покупки
$item1 = new Item();
$item2 = new Item();
$item3 = new Item();
//устанавливаем цены
$item1->setPrice (100);
$item2->setPrice (200);
$item3->setPrice (300);
//добавлякм в корзину наши товары
$cart = [];
$cart[] = $item1;
$cart[] = $item2;
$cart[] = $item3;
//устанавливаем сумму в 0 и слаживаем все элементы массива без скидки
$sum = 0;
foreach ($cart as $obj) {
    $sum += $obj->getPrice();
}
echo "Price without offer is - $sum<br>";

//устанавливаем сумму в 0
$sum = 0;
//устанавливаем скидку 20, если в корзине более 2х товаров
if (count($cart) > 2) Purchaise::setOffer (20);
//слаживаем суммы каждого товара с учетом скидки и выводим на экран
foreach ($cart as $obj) {
    $sum += $obj->getTotalPrice();
}
echo "Price with offer is - $price !!!<br>";