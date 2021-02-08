<?php

// urlpost.php
if (isset($_POST['url'])) {
    echo file_get_contents('http://' . SanitizeString($_POST['url']));
}
if (isset($_GET['url'])) {
    echo file_get_contents('http://' . SanitizeString($_GET['url']));
}
if (isset($_GET['xml'])) {
    header('Content-Type: text/xml');
    echo file_get_contents('http://' . SanitizeString($_GET['xml']));
}
if (isset($_POST['TEXT'])) {
    $text = SanitizeString($_POST['TEXT']);
    $new_text = "<p>$text</p>";
    $new_text .= $new_text;
    $new_text .= $new_text;
    echo $new_text;
}
if (isset($_GET['TEXT'])) {
    $text = SanitizeString($_GET['TEXT']);
    $new_text = "<p>$text</p>";
    $new_text .= $new_text;
    $new_text .= $new_text;
    echo $new_text;
}

function SanitizeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    return stripslashes($var);
}
