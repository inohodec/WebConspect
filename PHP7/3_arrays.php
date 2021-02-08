<?php
/*************************МАССИВЫ*********************************/

#-------list()------------
//list() присвоит переменным созданным внутри неё значения элементов массива по порядку
$name = ['Ostepan', 'Max', 'Yurievich'];
list($surname, $name, $patronymic) = $name; //создали 3 переменных $surname, $name, $patronymic и передали 
											//им значения массива
echo "$surname $name $patronymic";          //Вывод будет 'Ostepan Max Yurievich'
             //можно пропускать элементы
list(, $name, $patronymic) = $name;         // пропустит первое значение массива и присвоит 2 других 
list($surname, , $patronymic) = $name;      // пропустит второе значение массива и присвоит 2 других 
list(, , $patronymic) = $name;              // пропустит 2 первых значения массива и присвоит только последнее 

#-----sizeof()/count()-------------
//функции идентичны и возвращают длинну массива
sizeof($arr);
count($arr);
//если мы применяем функции к строкам, то они вернут "1"


#------слияние массивов------------
$arr1 = ["car" => "BMW", "tank" => "T-90"];
$arr2 = ["airplain" => "Boing"];
$arr_new = $arr1 + $arr2;//будет равен [car] => BMW [tank] => T-90 [airplain] => Boing, также если сделать $arr2 + $arr1 то получим [airplain] => Boing [car] => BMW [tank] => T-90

//Вожно что если слаживать массивы с одинаковыми ключани(например массивы где ключи это цифры), то в случае если значение с таким индексом существует, то в новый массив запишется только первое значения с данным ключём которое встретит интерпретатор.
$arr1 = ["car", "boat", "tank"];//в реале мы имеем массив вида [0]="car", [1]="boat", [2]"tank"
$arr2 = ["airplane", "bike", "wheel", "glyder"];//в реале мы имеем массив вида [0]"airplane", [1]"bike", [2]"wheel", [3]"glyder"
$arr_new = $arr1 + $arr2;   //в итоге мы получим $arr_new = [0]="car", [1]="boat", [2]"tank", [3]glyder т.к. во втором массиве есть значения с такими же ключами как и в первом массиве и интерпретатор проигнорирует значения с такими же ключами из второго массива


#------------Перебор ассоциативного массива(косвенный)-----------------
$arr1 = ["car" => "BMW", "tank" => "T-90", "airplain" => "Boing"];
foreach ($arr1 as $key => $value) {
	echo "Vehicle: ".$key .", model: ". $value."<br>";
}
//или используем конструкцию for
reset($array);//Устанавливает внутренний указатель массива на его первый элемент и возвращает его значение
next($array);//Устанавливает внутренний указатель массива на его следующий элемент и возвращает его значение
end($array);//Устанавливает внутренний указатель массива на его последний элемент и возвращает его значение
prev($array);//Устанавливает внутренний указатель массива на его предидущий элемент и возвращает его значение
current($array);////Устанавливает внутренний указатель массива на его текущий элемент, изначально если не применялись другие функции по перемещению внутреннего указателя, то это первый элемент массива и возвращает его значение
key($array); //возвращает индекс текущего элемента массива на котором стоит указатель.

$transport = array('foot', 'bike', 'car', 'plane');
$vehicle = current($transport); // $vehicle = 'foot';
$vehicle = next($transport);    // $vehicle = 'bike';
$vehicle = current($transport); // $vehicle = 'bike';
$vehicle = prev($transport);    // $vehicle = 'foot';
$vehicle = end($transport);     // $vehicle = 'plane';
$vehicle = current($transport); // $vehicle = 'plane';

//перебов с первого элемента
$arr1 = ["car" => "BMW", "tank" => "T-90", "airplain" => "Boing"];
for(reset($arr1); ($key = key($arr1)); next($arr1)) {
	echo "Vehicle: ".$key .", model: ". $arr1[$key]."<br>";
}
//перебов с последнего элемента
for (end($arr1); ($key = key($arr1)); prev($arr1)) {
	echo "Vehicle: ".$key .", model: ". $arr1[$key]."<br>";
}
//ВАЖНО!!! если вдруг в ассоциативном массиве возникнет значение с ключем "0"(что маловероятно), то цикл прерветься, т.к. $key == 0 и это расценится как FALSE, на всякий случай можно делать так: 
// for (end($arr1); ($key = key($arr1)) !== false; prev($arr1)) т.е. мы также "строго проверяем" значение нашего ключа


#------------Перебор ассоциативного массива(прямой) рекомендованный!!!-----------------

foreach ($arr1 as $key => $value) { //$key- ключ, $value - значение также можно опускать ключ($arr1 as $value)
	# code...
}
//стоит помнить, что цикл foreach создает копию переданного ему массиву и работает с ним
$numbers = [11, 55, 66];
foreach ($numbers as $value) {
	$value += 20;
}//в данном примере исзодный массив $numbers останется без изменения и если мы хотим воздействовать на переданный массив то должны использовать "жесткие ссылки"
$numbers = [11, 55, 66];
foreach ($numbers as &$value) {
	$value += 20;
}//значения массива $numbers станут [0] => 31 [1] => 75 [2] => 86 т.е. увеличатся на 20

/*
ВАЖНО!!! при создании жесткой ссылки в foreach, после работы цикла она не удаляеться и ведет на последний 
элемент обработанного массива, так что необходимо быть внимательным и не присваивать этой переменной ничего, 
так же как и не использовать в последующих циклах foreach(просто изменить переменную например с $value на $val 
и т.д.)
*/


#--------Массивы(списки) и строки-------------
//--explode($delimiter, $string, [limit]) - разбиение строки на массив
$string = "ID25445|Jack Back|The USA|Programmer";
$person = explode("|", $string);//создаст массив [0]ID25445, [1]Jack Back, [2]The USA, [3]Programmer 
list($id, $name, $origin, $profession) = $person;// $id=ID25445, $name=Jack Back, origin = The USA, $profession = programmer
$person = explode("|", $string, 3);//отделит только 3 первые элемента и 3му он присвоит остаток строки [0] => ID25445 [1] => Jack Back [2] => The USA|Programmer

//---implode($glue, $list_or_array) тоже что и join() склеивает массив в одну строку с указанным разделителем
$person = ["ID25445", "Jack Back", "The USA", "Programmer"];
$string = implode("|", $person);   //вернет строку "ID25445|Jack Back|The USA|Programmer"


//---------Слияние Массивов---------------------
$good = ["Arahanga"=>"Julian ", "Doran"=>"Matt"];
$bad = ["Goddard"=>"Paul", "Taylor"=>"Robert"];
$all = $good + $bad;								//получим ассоц. массив со всеми 4мя записями 

?>

//---------Формы и массивы----------------------

<!--при отправке формы  мы можем дать всем полям одно и то же имя, но разные ключи массива-->
<select name="profile[country][]" id="" multiple><!--в данном случае [country][] будет означать автомассив-->
        <option value="ua">Ukraine</option>
        <option value="ru">Russia</option>
</select>
<input type="radio" name="profile[sex]" id="man">
<input type="radio" name="profile[sex]" id="woman">
<input type="text" name="profile[name]"><br>
<input type="submit" name="profile[doGo]">

<?php
var_export($_REQUEST['profile']);
//вот что вернет наш массив при условии что мы выбрали в списке обе страны!
array (
  	'country' => array (0 => 'ua', 1 => 'ru'),
  	'sex' => 'man',
  	'name' => 'Denis',
  	'doGo' => 'Submit Query',
);
//т.е. можно обращаться к списку $_REQUEST['profile']['country'][0] и $_REQUEST['profile']['country'][1] или к остальным переменным $_REQUEST['profile']['sex'][0] , $_REQUEST['profile']['name'], $_REQUEST['profile']['doGo']

#--------------------Сериализация массивов---------------------------------
//если нам нужно записать массив в файл или т.п.(особенно ассоциативный) мы можем сериализировать массив, а потом десереализировать его
$string = ['name' => 'Max', 'surname' => 'Ostepan'];
$code = serialize($string);
echo $code; //a:2:{s:4:"name";s:3:"Max";s:7:"surname";s:7:"Ostepan";}
$decode = unserialize($code);//на выходе получим именно массив 1 в 1 как в переменной $string
//сеарелизовать можно практически любые данные
