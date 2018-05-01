<?php

include "../../dbCon.php";
$park=$_GET['park'];
echo "<script>alert('dilu')</script>";
$sql = "SELECT longitude,latitude from park  where parkName='" . $park . "'";
$result = mysqli_query($conn, $sql);
$myArray = array(); //...create an array...
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $myArray[] = $row;

}

echo json_encode($myArray);
?>