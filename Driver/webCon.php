<?php


$user="id5403109_root";
$password="maths@95";
$database="id5403109_animaltracer1";
$hostname="mysql2.000webhost.com";


$conn = new mysqli($hostname,$user,$password,$database);

if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>

