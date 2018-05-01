<!DOCTYPE html>
<html>
<head>
    <style>
        table.db-table {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            height: 20%;
            width: 50%
        }

        table.db-table th {
            background: #eee;
            padding: 15px;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }

        table.db-table td {
            padding: 15px;
            border-left: 1px solid #ccc;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<?php
include '../../dbCon.php';
$deviceId = $_GET['q'];
$sql = "Select * from device where deviceId='" . $deviceId . "'";
$valid = False;
if ($is_query_run = mysqli_query($conn, $sql)) {

    while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
        if ($deviceId == $row['deviceId']) {//checking validity of deviceId
            $valid = True;
        }
    }
}
if (preg_match("/[0-9]{3}DE/i", $deviceId) == 0) {
    echo "Please Give DeviceId in the given format. eg-150DE";
} else if($valid == False){
    echo "Device Id not valid. Please check again ";
}
else {
    $sql = "select ownerId,ownerName,parkName,tel_num1,tel_num2 from device natural join (deviceowner natural join telnumlist) where deviceId='" . $deviceId . "'";
    if ($is_query_run = mysqli_query($conn, $sql)) {
        echo "<br>";
        echo '<table cellpadding="0" cellspacing="0" class="db-table">';

        echo '<th>Owner Id</th><th>Owner Name</th><th>Park Name</th><th>Tel-No1</th><th>Tel-No2</th>';


        while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {


            echo '<tr>';
            echo '<td>' . $row['ownerId'] . '</td><td>' . $row['ownerName'] . '</td><td>' . $row['parkName'] . '</td><td>' . $row['tel_num1'] . '</td><td>' . $row['tel_num2'] . '</td>';
            echo '</tr>';

        }

    }
}