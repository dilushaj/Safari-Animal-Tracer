<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Device</title>
    <link href="vendor/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet"
          type="text/css">
    <link href="css/landing-page.min.css" rel="stylesheet">

</head>

<body>


<header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h1 class="mb-5">Start Your journey with Animal Tracer and experience a better safari</h1>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                <form action="DeviceUi.php" method="post">
                    <div class="form-row">
                        <div class="col-12 col-md-9 mb-2 mb-md-0">
                            <input type="text" class="form-control form-control-lg" placeholder="Enter Device Id..."
                                   name="deviceId" pattern="[0-9]{3}DE" title="eg:-150DE">
                        </div>
                        <div class="col-12 col-md-3">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Start</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</header>

</body>

</html>
<?php

if (isset($_POST['deviceId'])) {
    include "webCon.php";
    include "dbcon.php";
    $deviceId = $_POST['deviceId'];
    $sql = "Select * from device where deviceId='" . $deviceId . "'";
    $valid = False;
    if ($is_query_run = mysqli_query($conn, $sql)) {

        while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
            if ($deviceId == $row['deviceId']) {//checking validity of deviceId
                $valid = True;
                $sql1 = "SELECT COUNT(*) from device";
                $result1 = $conn1->query($sql1);
                $count = 1;
                while ($row = $result1->fetchArray(SQLITE3_ASSOC)) {
                    $count = $row['COUNT(*)'];

                }
                if ($count == 0) {
                    $sql = "INSERT INTO device(deviceId) VALUES('$deviceId')";
                    $result = $conn1->query($sql);
                    header("location: driverUi.php");
                } elseif ($count == 1) {
                    $sql2 = "SELECT deviceId from device";
                    $result2 = $conn1->query($sql2);
                    $device = "";
                    while ($row = $result2->fetchArray(SQLITE3_ASSOC)) {
                        $device = $row['deviceId'];

                    }
                    if ($device == $deviceId) {
                        header("location: driverUi.php");
                    } else {
                        echo "<script> alert('DeviceId Missmatch')</script>";
                    }
                } else {
                    echo "<script> alert('Invalid Input')</script>";
                }


            }
        }
        if ($valid == False) {
            echo "<script> alert('Invalid DeviceId')</script>";
        }
    }
}