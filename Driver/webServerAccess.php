<?php
include "DbAccess.php";
include "dbcon.php";
$dbAccess=new DbAccess();

$animal=$_GET['animal'];
$longitude=$_GET['longitude'];
$latitude=$_GET['latitude'];
$sql="Select deviceId from Device";
$result = $conn1->query($sql);
$deviceId="";
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    $deviceId=$row['deviceId'] . '<br/>';
}

$dbAccess->saveTowebServer($animal, $longitude, $latitude,$deviceId);