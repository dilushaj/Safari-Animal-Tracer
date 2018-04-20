<?php
include "DbAccess.php";

$dbAccess = new DbAccess();

$result = $dbAccess->queryLocalDatabase();//database query object


echo json_encode($result);
?>
