<?php
/*программа выводит имя пользователя и его права также выводит форму для входа 
и проверяет допустимость пары логин-пароль, если вход успешен то скрывает форму и выводит кнопку для выхода
  */
require_once 'db_connect_data.php';
require_once 'session_delete.php';
$conn = new mysqli($hn, $un, $pw, $db);
$curr_page = "session.php";

session_start();//старт сессии

//если есть $_POST['session_del'] то удаляем сессию
if (isset($_POST['session_del']) && $_POST['session_del'] == "del") delete_session_and_data();
//если ошибка в подключении к базе, то выводим ошибку функцией database_error
//и пропускаем проверку $_POST. Если все ОК, то проверяем пост на наличие данных
//и в если все ОК делаем запрос к БД
if ($conn->connect_error) database_error($conn->connect_error);
else {
    if (isset($_POST['user']) && isset($_POST['password']) && !empty($_POST['user']) && !empty($_POST['password'])) {
        //дезинфекция данных из пост
        $user = desinfection($conn, $_POST['user']);
        $pswrd = desinfection($conn, $_POST['password']); 
        //солим и криптуем пароль
        $salt_pre = ".*/.!";
        $salt_post = "%&@4";
        $token = hash('ripemd128',"$salt_pre$pswrd$salt_post");
        //запрос к БД
        $query = "SELECT password,rights FROM users WHERE name='$user'";
        $result = $conn->query($query);
        //если $result возвращает 0 что равнозначно FALSE выводим ошибку
        //если ОК то сравниваем данные из БД с введенным паролем
        if (!$result) echo '<p>Wrong couple LOGIN PASSWORD '.$conn->error.'</p>';
        
        elseif ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_NUM);
            //если пароль из БД и формы совпадают, присваиваем сессии значения имени и прав
            if($token == $row[0]) {
                $_SESSION['user'] = $user;
                $_SESSION['rights'] = $row[1];
                
            }
        }
    }
}
//если есть имя и права в сессии то присваеваем переменным значения
//пльзователя и прав из массива $_SESSION иначе присваиваем значение Guest и т.д
if (isset($_SESSION['user'])) {
    $user_name = $_SESSION['user'];
    $user_rights = $_SESSION['rights'];
   
}
else {
    $user_name = "guest";
    $user_rights = "Just a guest";
}
//если $_SESSION['user']) существует то присваиваем переменной значение формы
//если нет, то пустое значение ""
if (isset($_SESSION['user'])) {
    $session_del = "<form action='session.php' method='post'>";
    $session_del .= "<input type='hidden' name='session_del' value='del'>";
    $session_del .= "<input type='submit' value='Log Out'>";
    $session_del .= "</form>";
} 
else $session_del = "";
//выводим имя и права
echo <<<_HTML
<div>
    <hr>
    <p>Hello: $user_name; You're: $user_rights</>
    <p>$session_del</p>
</div>
_HTML;
//если значения $_SESSION['user']) нет, то выводим форму входа 
if (!isset($_SESSION['user'])) {
echo <<<_HTML
<form action='session.php' method='POST'>
    <input type="text" name="user" id="user" placeholder='name'>
    <input type="text" name="password" id="pswrd" placeholder='password'>
    <input type='submit' value='Log In'>
</form>
_HTML;
}
//выводим ссылку на след страницу
echo <<<_HTML
<hr>
<a href='next_page.php'>next page</a>
_HTML;
//Закрываем подключение к БД
$result->close();
$conn->close();

//-----------------DB output error
function database_error($message) {
    echo "<p>There is error in connection: $message</p>";
}
//--------------Desinfection Function-------------------
function desinfection($conn, $value) {
    return htmlentities(desinfection_inner($conn, $value));
}
function desinfection_inner($conn, $value) {
    if (get_magic_quotes_gpc()) $value = stripcslashes($value);
    return $conn->real_escape_string($value);
}
