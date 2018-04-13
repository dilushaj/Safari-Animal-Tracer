<?php
include "DbAccess.php";
include "dbcon.php";
$dbAccess=new DbAccess();
$sql="Select deviceId from Device";
$result = $conn1->query($sql);
$deviceId="";
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    $deviceId=$row['deviceId'] . '<br/>';
}

date_default_timezone_set('Africa/Abidjan');
$time = date("Y-m-d H:i:s", time());

$dbAccess->queryWebServer($deviceId,$time);
