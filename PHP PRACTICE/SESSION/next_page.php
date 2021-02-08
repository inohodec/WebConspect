<?php
/*Страница выдает результыт в зависимости от данных полученных из массива $_SESSION
если гость то выдается один текст, если говернор то другой и если вассал то третий
 * также если выполнен вход то добавляет кнопку выхода
  */
require_once 'session_delete.php';
session_start();
if (isset($_POST['session_del']) && $_POST['session_del'] == "del") delete_session_and_data();
if (!isset($_SESSION['user'])) {
    $user_name = "Guest";
    $user_rights = "Just a guest";
    $article = "<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";
}
elseif (isset($_SESSION['user']) && isset($_SESSION['rights'])) {
    $user_name = $_SESSION['user'];
    $user_rights = $_SESSION['rights'];
    
    if ($_SESSION['rights'] == "governor") {
        $article = "<p>Сессии искусно ограничивают одной программой весь объемный код, необхо-
                димый для аутентификации и регистрации пользователя. После аутентификации
                пользователя и создания сессии весь остальной программный код действительно
                упрощается. Нужно лишь вызвать функцию session_start и найти любые пере-
                менные, к которым нужен доступ из массива \$_SESSION .
                В примере 12.6 быстрой проверки наличия значения у элемента \$_SESSION['userna-
                me'] вполне достаточно для того, чтобы узнать об аутентификации текущего поль-
                зователя, потому что переменные сессии хранятся на сервере (в отличие от cookie,
                которые хранятся на машине браузера) и им можно доверять.</p>";
    }
    elseif ($_SESSION['rights'] == "vassal") {
        $article = "Программа continue.php выводит значение пользовательского пароля, чтобы показать, как
                работают переменные сессии. На практике вам будет известно, что пользователь уже за-
                регистрировался, поэтому отслеживать (или выводить) любые пароли нет необходимости,
                тем более что подобные действия угрожают безопасности системы.";
    }
}
if (isset($_SESSION['user'])) {
    $session_del = "<form action='next_page.php' method='post'>";
    $session_del .= "<input type='hidden' name='session_del' value='del'>";
    $session_del .= "<input type='submit' value='Log Out'>";
    $session_del .= "</form>";
} else $session_del = "";
echo <<<_HTML
<hr>
<p>Hello: $user_name; You're: $user_rights</>
<p>$session_del</p>
<hr>
$article
<br>
<a href='session.php'>main page</a>
_HTML;
