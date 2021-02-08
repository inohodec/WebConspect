<?php
//перебераем просто массив, foreach принимает 2 параметра
//первый это массив а второй это переменная в которую поочередно будет 
//выводится значения массива
$brands = array('adidas','puma','nike','umbro');

foreach ($brands as $value) {
    echo $value.'<br>';
}
echo '<hr>';

//то же что и выше, но вместо второго значения мы имеем два(ключ и его значение)
$brands = array(
    'adidas'=>'t-shorts',
    'puma'=>'trainers',
    'nike'=>'acessories',
    'umbro'=>'jackets');

foreach ($brands as $key => $value) {
    echo $key.': '.$value.'<br>';
}
echo '<hr>';
/*-------------------------------------------------*/
$cars = array(
    'bmw'=>'sport car',
    'audi'=>'premium car',
    'renault'=>'just a good car',
    'lanos'=>'ugly car');
//while будет выполняться пока не получит значение FALSE
//Функция  list в качестве аргументов принимает массив 
//(в данном случае пару «ключ — значение», возвращенную функцией  each), 
//а затем присваивает значения массива переменным, перечисленным внутри круглых скобок.
while (list($car_brand, $car_type) = each($cars)) {
    echo "$car_brand is - $car_type<br>";
}

/*МНОГОМЕРНЫЙ МАССИВ*/
$books_shops = array(
    'Kyiv'=>array(
      'KyivBOOK'=>'Fiction Book',
      'CapitalBOOK'=>'Histirican Literature'
    ),
    'Dnipro'=>array(
      'DneprBOOK'=>'Love Stories',
      'JidovsiyBOOK'=>'Jidovskie Vesti'
    ),
    'Odessa'=>array(
      'OdessaBOOK'=>'Self Improvement',
      'MorsieBOOK'=>'Sea Stories'
    )
); 

foreach ($books_shops as $cities => $shop_list) {
    echo '<hr>';
    foreach ($shop_list as $shop_name => $ganre) {
        echo "$cities <br> $shop_name : $ganre.";
    }
    echo '<hr>';
}
