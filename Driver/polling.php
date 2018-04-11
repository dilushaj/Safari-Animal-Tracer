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
$dbAccess->queryWebServer($deviceId);