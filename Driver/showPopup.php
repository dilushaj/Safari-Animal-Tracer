<?php
include "DbAccess.php";

$dbAccess = new DbAccess();

$result = $dbAccess->queryLocalDatabase();//database query object



$myArray = array(); //...create an array...
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
    $myArray[] = $row;

}

echo json_encode($myArray);
?>
