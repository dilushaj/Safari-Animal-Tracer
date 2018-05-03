<?php
include "Report.php";

$report=new Report();

$park=$_GET['park'];
$result=$report->setMap($park);
$myArray = array(); //...create an array...
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $myArray[] = $row;

}

echo json_encode($myArray);
?>