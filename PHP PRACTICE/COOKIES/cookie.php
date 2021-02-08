<?php
//checking of POST if it exists then we create COOKIE 
if (isset($_POST['user']) && $_POST['user'] != "") {
    $name = $_POST['user'];
    setcookie("name", $name, time()+ 60);//life expectancy are 60 seconds
}
elseif (isset($_POST['delete'])) {
    setcookie("name",$_COOKIE['name'], time() - 60000);
    
}
//if COOKIE doesn't exist we output form to enter name
if (!isset($_COOKIE['name'])) {
    $name = "Guest";
    $content = "";
    echo <<<_END
    HELLO $name;
    <form action="cookie.php" method="POST">
            <input type="text" name="user" autocomplete="off">
            <input type="submit">
    </form>
_END;
}
//if COOKIE exists we output button to delete COOKIE
 else {
    $name = $_COOKIE['name'];
    echo <<<_END
    <hr>
    HELLO $name
    <hr>
    <form action="cookie.php" method="POST">
            <input type="hidden" name="delete" id="delete" value="del">
            <input type="submit" value="DELETE $name">
    </form> 
_END;
}
//end of main code
echo "<br><a href='next_cookie_page.php'>Nent page</a>";
if (isset($_COOKIE['name'])) $content = "<h1 style='text-align: center; color: red;'>Hello user</h1>";
else $content = "";
echo $content;
    

