<?php
include 'dbcon.php';
include "DbAccess.php";
$dbAccess=new DbAccess();
$sql1="Select deviceId from Device";
$sql2="select * from animal where globalStatus='not broadcasted'";
$sql3="Update animal set globalStatus='broadcasted' where globalStatus='not broadcasted' ";
$conn1->busyTimeout(5000);
$conn1->exec('PRAGMA journal_mode = wal;');
$conn1->query("begin transaction");
$result1 = $conn1->query($sql1);
$deviceId="";
while ($row = $result1->fetchArray(SQLITE3_ASSOC)){
    $deviceId=$row['deviceId'] . '<br/>';
}

$result2 = $conn1->query($sql2);
while ($row = $result2->fetchArray(SQLITE3_ASSOC)){

    $dbAccess->saveToWebServer($row['animalName'],$row['longitude'],$row['latitude'],$deviceId,$row['time']);
}
$conn1->query($sql3);
$conn1->query("commit");
$conn1->close();