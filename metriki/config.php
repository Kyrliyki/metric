<?php
session_start();
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'medel');

 
// Подключение к базе данных
$DataBase = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Проверка подключения
if($DataBase === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>