<?php

$conn1 = new SQLite3('mydatabase.sqlite');
$deviceId="150";
echo preg_match("/[0-9]{3}DE/i", $deviceId);

?>

