<?php


$user="sql12236689";
$password="K5sNSDtjMl";
$database="sql12236689";
$hostname="sql12.freesqldatabase.com";
$port="3306";

$conn = mysqli_connect($hostname,$user,$password,$database);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

