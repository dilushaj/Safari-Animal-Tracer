<?php
include 'dbcon.php';
$sql1="Select deviceId from Device";
$result = $conn1->query($sql);
$deviceId="";
while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    $deviceId=$row['deviceId'] . '<br/>';
}
$sql2="select * from animal where globalStatus='not broadcasted'";
