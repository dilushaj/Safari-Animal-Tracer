<?php
include "DbAccess.php";


$dbAccess=new DbAccess();


$animal=$_GET['animal'];
$longitude=$_GET['longitude'];
$latitude=$_GET['latitude'];
$broadcasted=$_GET['broadcasted'];
date_default_timezone_set('Africa/Abidjan');
$time = date("Y-m-d H:i:s", time());


$dbAccess->saveToLocalDatabase($animal, $longitude, $latitude, $broadcasted,$time);