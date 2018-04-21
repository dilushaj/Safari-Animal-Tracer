<?php


$user="sql12233860";
$password="kH12CJ4UZ3";
$database="sql12233860";
$hostname="sql12.freesqldatabase.com";
$port="3306";

$conn = mysqli_connect($hostname,$user,$password,$database);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

