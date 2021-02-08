<?php

try {
	$pdo = new PDO('mysql:host=localhost;dbname=some_name', 'user_name', 'password', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
	$query = "SELECT * FROM table WHERE id > 5";						//Возвращает версию MySQL сервера
	$ver = $pdo->query($query);									//Получает объект PDOStatement для доступа к данным
	while ($row = $ver->fetch(PDO::FETCH_ASSOC)) {
		print_r($row); 		//выведет ассоциативный массив
	}
} 
catch(PDOExeption $error)//		Вывалится при ошибке подключения к БД 
{
	echo "Couldn't connect to DB because of $error";
} 
// ...some code

//=================== Подготовленные выражения =======================/
//-------------- Строчки общие для всех 3х примеров ----------------
$val = '3';														//id нашего элемента для выборки из БД
$conn = Core\Component\AppHelper::getConnection();				//получаем PDO объект (аналог new PDO...)

/********************* Variant 1 **************************/
$query = "SELECT name, alias FROM articles WHERE id = :id";		//Пишем наше выражение где :id это псевдопеременная, вместо которой мы подставим значение
$name = $conn->prepare($query);									//Подготавливаем выражение
$name->execute(['id' => $val]);									//Выполняем наш запрос передавая массив  
$result = $name->fetchAll(PDO::FETCH_ASSOC);					//Получаем массив с данными
/********************* Variant 2 **************************************/
$query = "SELECT name, alias FROM articles WHERE id = :id";     //Пишем наше выражение где :id это псевдопеременная, вместо которой мы подставим значение
$name = $conn->prepare($query);									//Подготавливаем выражение
$name->bindParam(':id', $val, PDO::PARAM_INT);					//Привязываем значение к псевдопеременной и PDO::PARAM_INT проверяет, что бы значение было числом int
$name->execute();												//выполняем запрос без параметров
$result = $name->fetchAll(PDO::FETCH_ASSOC);					//Получаем массив с данными

$query = "SELECT name, content, img FROM articles LIMIT :start, :finish";
$stmt = $conn->prepare($query);
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':finish', $finish, PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
/************************************************************************/
$query = "SELECT name, alias from articles WHERE id = ?";
$name = $conn->prepare($query);
$name->execute([$val]);
$result = $name->fetchAll(PDO::FETCH_ASSOC);
/***********************************************************************/
$query = "Select name, alias from articles WHERE id = ?";
$name = $conn->prepare($query);
$name->execute([$val]);
$result = $name->fetch(PDO::FETCH_ASSOC);

while ($row = $result->fetch(PDO::FETCH_CLASS)) {
    echo "<pre>";
	var_dump($row);
	echo "</pre>";
}


=========================== ЗАМЕТКИ ============================
//с методом fetch используем PDO::FETCH_OBJ, тк FETCH_CLASS выведет ошибку
$result->fetch(PDO::FETCH_OBJ);  


//с методом fetchAll можно использовать два варианта

//если мы запрашиваем даннае состоящие из одной строки то можно использовать
$pdo = new PDO('mysql:host=localhost;dbname=bank', 'max', 'max');
$query = "SELECT * FROM account WHERE account_id=5";
$result = $pdo->query($query);

$user = $result->fetch(PDO::FETCH_OBJ);			//вернет объект который можно использовать напрямую
echo $user->product_cd;
echo $user->open_date;       
 