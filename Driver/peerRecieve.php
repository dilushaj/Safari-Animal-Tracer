<?php
include "DbAccess.php";


$dbAccess=new DbAccess();


$animal=$_GET['animal'];
$longitude=$_GET['longitude'];
$latitude=$_GET['latitude'];
$broadcasted=$_GET['broadcasted'];
$time =$_GET['time'];


$dbAccess->saveToLocalDatabase($animal, $longitude, $latitude, $broadcasted,$time);