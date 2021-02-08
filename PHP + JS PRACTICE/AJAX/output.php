<?php

//проверяем наличие $_POST['url'] или isset($_POST['name']
//если одно из значений есть, то создаем соединение к БЛ
if (isset($_POST['url']) || isset($_POST['name'])) {
    $conn = new mysqli('localhost', 'max', 'max', 'publications');
    if ($conn->connect_error)
        echo "There's error in connection: " . $conn->connect_error;
    //если при создании подключения к БД не было ошибок, то запускаем необходимую функцию
    //в зависимости от полуменного  $_POST
    else {
        if (isset($_POST['url']))//если присутствует $_POST['url'] - то выводим все записи из БД
            showEntries($conn);
        elseif (isset($_POST['name'])) {//если присутствует $_POST['name'] - то удаляем запись из БД и выводим все записи из БД
            $id = $_POST['name'];
            echo "<p style='color:red;'>\"Entry\" has just been deleted.</p>";
            dbDelete($conn, $id);
        }
    }
    $conn->close();
}

function dbDelete($conn, $id) {
    $query = "DELETE FROM meals WHERE id='$id'";
    $result = $conn->query($query);
    if (!$result) {//если в запросе к таблице была ошибка, то выводим её
        echo $conn->error;
    }
    //В данном случае $result возвращает значение BOOLEAN 0 или 1, если попытаться закрыть его, то получим ошибку
    //*************************************************
    //после удаления выводим оставшие записи при помощи функции showEntries($conn)
    showEntries($conn);
}

function showEntries($conn) {

    $query = "SELECT * FROM meals";
    $result = $conn->query($query);
    if (!$result) {//если в запросе к таблице была ошибка, то выводим её
        echo 'Error in the querry: ' . $conn->error;
    } else {
        $rows = $result->num_rows; //получаем количество строк из ответе ДБ
        for ($i = 0; $i < $rows; $i++) {
            $result->data_seek($i); //устанавливаем указатель на текущую строку ответа
            $curr_row = $result->fetch_array(MYSQLI_NUM); //передаем строку на которой стоит указатель
            //переменной $curr_row в виде нумерованного массива
            //*****************************************
            //добавляем в вывод две кнопки с повешенными на них функциями из JS
            //важно что передаваемый в функцию атрибут this возвражает в нее сам элемент по которому нажали
            //как объект, к которому можно применять методы JS (all information above only is for JS)
            echo <<<_HTML
                <div id='$curr_row[0]'>
                <p>$curr_row[0] * $curr_row[1] * $curr_row[2] * $curr_row[3]</p>
                <button id="$curr_row[0]" onclick=delDiv(this)>DELETE $curr_row[3]</button>
                <button id="$curr_row[3]" onclick=ajax(this) data-meal-ID="$curr_row[0]">DELETE $curr_row[3] from DB</button>
                </div>
_HTML;
        }
    }
    $result->close();
}
