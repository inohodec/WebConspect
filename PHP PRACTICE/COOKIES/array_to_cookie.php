<?php
$array = array(
    'name' => 'Max',
    'login' => 'inohodec',
    'password' => '12345'
);
$to_cookie = serialize($array);

setcookie('user_info', $to_cookie, time() + 60);
$second_array = unserialize($_COOKIE['user_info']);

print_r($second_array);
