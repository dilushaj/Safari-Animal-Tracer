<?php
include "DbAccess.php";
include "dbcon.php";


$sql1 = "Select deviceId from Device";
$result1 = $conn1->query($sql1);
$deviceId = "";
while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
    $deviceId = $row['deviceId'];
}
$dbAccess = new DbAccess();
$dbAccess->queryWebServer($deviceId);
