<?php
include "Report.php";
$report=new Report();

$park=$_GET['park'];
$duration= $_GET['duration'];
$animal=$_GET['animal'];
$result = $report->queryDb($park, $animal, $duration);//database query object
//$result = $report->queryDb("Udawalawe National Park", "all", "prevoius day");

echo json_encode($result);
?>