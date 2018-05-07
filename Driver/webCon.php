<?php


$user="sql2236776";
$password="cT6!mE8!";
$database="sql2236776";
$hostname="sql2.freesqldatabase.com";
$port="3306";

$conn = mysqli_connect($hostname,$user,$password,$database);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

