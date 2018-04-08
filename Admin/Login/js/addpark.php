<?php
include "Park.php";
$newPark= new Park();



$park=$_GET['park'];
$latitude=$_GET['latitude'];
$longitude=$_GET['longitude'];
$newPark->savePark($park, $latitude , $longitude);



