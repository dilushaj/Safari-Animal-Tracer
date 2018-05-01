<?php


$user="sql12235305";
$password="dULWPjKQNf";
$database="sql12235305";
$hostname="sql12.freesqldatabase.com";
$port="3306";

$conn = mysqli_connect($hostname,$user,$password,$database);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

