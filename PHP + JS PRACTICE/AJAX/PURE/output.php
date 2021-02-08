<?php

if (isset($_POST['url']) || isset($_POST['name'])) {
    $conn = new mysqli('localhost', 'max', 'max', 'publications');
    if ($conn->connect_error)
        echo "There's error in connection: " . $conn->connect_error;
    else {
        if (isset($_POST['url']))
            showEntries($conn);
        elseif (isset($_POST['name'])) {
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
    if (!$result) {
        echo $conn->error;
    }
    showEntries($conn);
}

function showEntries($conn) {
    $query = "SELECT * FROM meals";
    $result = $conn->query($query);
    if (!$result) {
        echo 'Error in the querry: ' . $conn->error;
    } else {
        $rows = $result->num_rows; 
        for ($i = 0; $i < $rows; $i++) {
            $result->data_seek($i); 
            $curr_row = $result->fetch_array(MYSQLI_NUM); 
            echo <<<_HTML
                <div id='$curr_row[0]'>
                <p>$curr_row[0] * $curr_row[1] * $curr_row[2] * $curr_row[3]</p>
                <button id="$curr_row[0]" onclick=delDiv(this)>DELETE $curr_row[3] from DOM</button>
                <button id="$curr_row[3]" onclick=ajax(this) data-meal-ID="$curr_row[0]">DELETE $curr_row[3] from DB</button>
                </div>
_HTML;
        }
    }
    $result->close();
}
