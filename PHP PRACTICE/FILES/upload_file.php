<?php
// важно для формы предназначенной для отправки файлов enctype="multipart/form-data
echo <<<_HTML
<form action='upload_file.php' method='POST' enctype="multipart/form-data">
    <input type='file' name='filename' placeholder='message'>
    <input type='submit' value='Send file'>
</form>
_HTML;
// Важно, что имя первого указателя $_FILES['filename'] беоется из POST запроса
// а точнее из отправленной формы и атрибута name="some_name" поля input type="file"
// те если <input type='file' name='filename'> то $_FILES['filename']['']
// если <input type='file' name='fileToUpload'> то $_FILES['fileToUpload'][''] и т.д.
if ($_FILES) {
    //получаем имя файла
    $file_name = $_FILES['filename']['name'];
    
    //проверяем допустимость файла
    $file_type = $_FILES['filename']['type'];
    switch ($file_type) {
        case 'image/jpeg':
            $file_extention = 'jpeg';
            break;
        case 'image/gif':
            $file_extention = 'gif';
            break;
        case 'image/png':
            $file_extention = 'png';
            break;
        case 'image/tif':
            $file_extention = 'tif';
            break;
        default: $file_extention = FALSE;
    }
    //если формат ОК то переносим его в постоянное место хранения, если нет, то ошибка
    if ($file_extention) {
        //переносим временный файл в указанное место
        //move_uploaded_file(откуда, куда)
        move_uploaded_file($_FILES['filename']['tmp_name'], "img/".$file_name);
        echo "<p>You've just uploaded image, it's format is '$file_extention'</p><img src='img/$file_name' style='max-width: 400px;'>";
    }
    else        echo '<p>Inappropriate file format</p>';
}

/* глобальный массив $_FILES одержит такие значения:
$_FILES['filename']['name'] - имя загружаемого файла
$_FILES['filename']['type'] - тип содержимого файла
$_FILES['filename']['size'] - размер в байтах
$_FILES['filename']['tmp_name'] - имя временного файла на сервере сразу после загрузки
$_FILES['filename']['error'] - код ошибки после загрузки файла
 */
 