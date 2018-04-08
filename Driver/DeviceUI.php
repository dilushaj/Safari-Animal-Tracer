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


<!-- Masthead -->
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

    include "dbcon.php";
    $deviceId = $_POST['deviceId'];
    $sql = "Select * from device where deviceId='" . $deviceId . "'";
    $conn = new mysqli("localhost", "root", "", "animaltracer1");
    if (mysqli_connect_error()) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    if ($is_query_run = mysqli_query($conn, $sql)) {

        while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
            if ($deviceId == $row['deviceId']) {
                $sql = "INSERT INTO device(deviceId)
				VALUES('$deviceId')";
                $result = $conn1->query($sql);


                header("location: driverUi.php");
            } else {
                echo "<script> alert('Invalid DeviceId')</script>";
            }
        }

    }
}