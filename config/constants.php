<?php 

//start session
session_start();

//create constants to store non reapeting values
define('SITEURL','http://localhost/food-order/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_connect_error()); //database connection
$db_select = mysqli_select_db($conn ,DB_NAME) or die(mysqli_error($conn)); //selecting database

?>