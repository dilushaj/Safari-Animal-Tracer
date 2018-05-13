<?php
include "DbAccess.php";

$dbAccess = new DbAccess();

$result = $dbAccess->peerConnect();//database query object


echo json_encode($result);
