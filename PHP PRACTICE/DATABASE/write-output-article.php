<?php
//CONNECT WITH DATABASE
$connection = new mysqli('localhost', 'max', 'max', 'publications');
if ($connection->connect_error) die('There is problem: '.$connection->connect_error);
//IF WE SEND ARTICLE WE WRITE IT IN DATABASE
if (isset($_POST['article']) && !empty($_POST['article'])) {
    $article = htmlspecialchars($_POST['article'], ENT_QUOTES);//CODE HTML SPECIAL CHARACTERS
    $query = "UPDATE article SET article='$article' WHERE author='max'";
    $result = $connection->query($query);
    if(!$result) die($connection->error);
    else        echo 'Data has just inserted';
}
//OUTPUT FORM
echo <<<_HTML
    <form action="" method="POST">
	<textarea name="article" id="" cols="30" rows="10"></textarea>
        <hr>
	<input type="checkbox" name="show" id="show"><label for="show">Show Article</>
        <br>
	<input type="submit" value="Send">
    </form>
_HTML;
//IF "SHOW" IS CHECKED THAN SHOW ARTICLE
if (isset($_POST['show'])) {
    $query = "SELECT article FROM article WHERE author='max'";
    $result = $connection->query($query);
    if (!$result) die ("There's error $connection->error");
    $result->data_seek(0);//SET POINTER ON FIRST LINE
    $article = $result->fetch_array(MYSQL_NUM);//RETURN ARRAY
    $article = htmlspecialchars_decode($article[0]);//DECODE IN PLAIN HTML
   
    echo <<<_HTML
    $article
_HTML;
