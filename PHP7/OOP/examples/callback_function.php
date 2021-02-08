<?php
//Функции обратного вызова!!!

class Product { //класс для хранения типа обуви и цены принимает
    private $name;
    private $price;
    //устанавливаем принятые от пользователя переменные
    function __construct($name, $size) {
        $this->name = $name;
        $this->price = $size;
    }
}

class ProcessSale {
    private $callbacks;//массив для хранения функций
    //проверяет возможно ли вызвать переменную(т.е. функция ли это) и если ОК, то записывает в массив
    function registerCallback ($callback) {
        if (!is_callable($callback)) {
            throw new Exception( "Function isn't callable!!");
        }
        $this->callbacks[] = $callback;
    }
    //принимает объект класса Product(тип и цену обуви) и распечатывает инфу
    function sale (Product $product) {
        print "{$product->name}: processing... \n";
        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }
}
//Вариант с анонимной функцией
$logger = function (Product $product) { //это в общем и есть ф-ция обратного вызова
    print "Writing ({$product->name})";
};
//Вариант с классом и его методом
class Mailer {
    function doMail (Product $product) {
        print "Packaging ({$product->name})";
    }
}
try {
    $processor = new ProcessSale();
    $processor->registerCallback($logger);//передаем в метод ф-цию обратного вызова
    $processor->sale(new Product("Clarks Shoes", 9.5));
    echo "<br>";
    $processor->sale(new Product("Merrell boots", 10));
    echo "<hr>";
    $processor1 = new ProcessSale();
    $processor1->registerCallback([new Mailer(), 'doMail']);
    /*Передаемв метод вместо ф-кции обратного вызова массив
     Первым элементом этого массива является объект типа Mailer, а вторым - строка. содержащая имя метода,
    который мы хотим вызвать. Помните, что в методе registerCallback() с помощью функции is_callable()
    выполняется проверка аргумента на предмет того, можно ли его вызвать? Данная функция достаточно
    интеллектуальна и распознает массивы подобного вида. Поэтому при указании функции обратного вызова
    в виде массива в первом элементе такого массива должен находиться объект, содержащий вызываемый метод,
    а имя этого метода помещается в виде строки во второй элемент массива. Таким образом, мы успешно прошли
    проверку типа аргумента, и вот что выведет программа в результате.
     */

    $processor1->sale(new Product("Reebok Sneakers", 25));
    $processor1->registerCallback('fhfhh');


} catch (Exception $error) {
    die "<br>".$error->getMessage();
}


/* OUTPUT

Clarks Shoes: processing... Writing (Clarks Shoes)
Merrell boots: processing... Writing (Merrell boots)

Reebok Sneakers: processing... Packaging (Reebok Sneakers)
Function isn't callable!!

*/
