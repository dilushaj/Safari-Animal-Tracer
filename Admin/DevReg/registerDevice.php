<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Device Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">


    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>


</head>

<body>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo span4">
                <h1><a href="">Device Register<span class="green">.</span></a></h1>
            </div>
            <div class="links span8">
                <a class="home" href="../Home/index.html" rel="tooltip" data-placement="bottom"
                   data-original-title="Home"></a>
                <a class="logout" href="../Login/login.php" rel="tooltip" data-placement="bottom"
                   data-original-title="Logout"></a>
            </div>
        </div>
    </div>
</div>

<div class="register-container container">
    <div class="row">
        <div class="iphone span5">
            <img src="assets/img/iphone.png" alt="">
        </div>
        <div class="register span6">
            <form action="registerDevice.php" method="POST">
                <h2><strong>REGISTER HERE</strong><span class="green"></span></h2>
                <label for="deviceid">Device Id</label>
                <input type="text" id="deviceid" name="deviceid" placeholder="Enter Device Id..."
                       pattern="[0-9]{3}+/[DE]">
                <label for="parkname">Select park:</label>
                <?php
                $conn1 = new PDO('mysql:host = localhost;dbname=animaltracer1', 'root', '');
                $sql = "SELECT parkName FROM park";
                $stmt = $conn1->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll();
                ?>
                <select name="park">
                    <?php foreach ($users as $row):
                        ?>
                        <option value="<?= $row['parkName']; ?>"><?= $row['parkName']; ?></option>
                    <?php endforeach; ?>
                </select>
                <!--select name="park">
                    <option value="single">Udawalwe National Park</option>
                    <option value="double">Yala National Park</option></select-->


                <label for="Ownerid">Owner Id</label>
                <input type="text" id="ownerid" name="ownerid" placeholder="Enter Owner Id..." pattern="[0-9]{3}+/[DR]">

                <label for="ownername">Owner Name</label>
                <input type="text" id="ownername" name="ownername" placeholder="Responsible person...">
                <label> Telephone Number 1(start with 94 instead of 0): </label>
                <input type="text" name="tpNum1" placeholder="1st telephone no.."><br>
                <label> Telephone Number 2(start with 94 instead of 0): </label>
                <input type="text" name="tpNum2" placeholder="2nd telephone no.."><br><br><br>
                <button type="submit">REGISTER</button>
            </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="assets/js/jquery-1.8.2.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.backstretch.min.js"></script>
<script src="assets/js/scripts.js"></script>


</body>
</html>

<?php

include '../../dbCon.php';
session_start();
function length($inputtxt, $length)//check the valid lengths of user inputs
{
    $userInput = $inputtxt;
    if (strlen($userInput) == $length) {
        return true;
    } else {
        return false;
    }
}

//validate data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function tel_numValidate($tel_num){

    $access_key = 'cf430ee08f53245cf53b9fe946fa793a';
    $phone_number = $tel_num;
    $ch = curl_init('http://apilayer.net/api/validate?access_key='.$access_key.'&number='.$phone_number.'');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $validationResult = json_decode($json, true);
    return $validationResult['valid'];
}

$errors = "";
// validate deviceID
if (empty(test_input($_POST['deviceid']))) {
    $errors = "error-complete deviceId";
    echo "<script> alert('error-complete device Id')</script>";
    echo "<script> window.history.go(-1);</script>";
} else if (length($_POST['deviceid'], '5') and preg_match("/[0-9]{3}DE/i", $_POST['deviceid']) == 1 ) {
    $deviceid = $_POST['deviceid'];
} else {
    $errors = "error-invalid id";
    echo "<script> alert('error-please enter a valid ID')</script>";
    echo "<script> window.history.go(-1);</script>";
}
//validate park name
if (empty(test_input($_POST['park']))) {
    $errors = "error-complete all fields2";
    echo "<script> alert('error-complete park')</script>";
    echo "<script> window.history.go(-1);</script>";
} else {
    $park = $_POST['park'];
}
//validate owner Id
if (empty(test_input($_POST['ownerid']))) {
    $errors = "error-complete all fields3";
    echo "<script> alert('error-complete owner ID')</script>";
    echo "<script> window.history.go(-1);</script>";
} else if (length($_POST['ownerid'], '5')  and preg_match("/[0-9]{3}DR/i", $_POST['ownerid']) == 1) {
    $ownerid = $_POST['ownerid'];
} else {
    $errors = "error-invalid id";
    echo "<script> alert('error-please enter a valid ID')</script>";
    echo "<script> window.history.go(-1);</script>";
}
//validate owner name
if (empty(test_input($_POST['ownername']))) {
    $errors = "error-complete all fields2";
    echo "<script> alert('error-complete owner name')</script>";
    echo "<script> window.history.go(-1);</script>";
} else if (ctype_alpha(test_input($_POST['ownername'])) == false) {
    $errors = " name should only contain letters";
    echo "<script> alert('error-name should only contain letters')</script>";
    echo "<script> window.history.go(-1);</script>";
} else {
    $ownername = test_input($_POST['ownername']);
}

//validate tpNum1
if (test_input(empty($_POST['tpNum1']))) {
    $errors = "error-complete all fields5";
    echo "<script> alert('error-complete telephone no1')</script>";
    echo "<script> window.history.go(-1);</script>";

} else if (length($_POST['tpNum1'], '11') and tel_numValidate($_POST['tpNum1'])=="1") {
    $tpNum1 = ($_POST['tpNum1']);
} else {
    $errors = "error-invalid telephone No";
    echo "<script> alert('error-Please enter a valid telephone number starting with 94')</script>";
    echo "<script> window.history.go(-1);</script>";
}
//validate tpNum2-optional to provide
if (length($_POST['tpNum2'], '11') and tel_numValidate($_POST['tpNum2'])=="1") {
    $tpNum2 = ($_POST['tpNum2']);
} else {
    $tpNum2="";
}
if($errors=="") {
    mysqli_query($conn, "INSERT INTO deviceowner(ownerId,ownerName) 
VALUES('$ownerid','$ownername')");

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script> alert('Owner Added Successfully')</script>";
        //add device only if owner added successfully
        mysqli_query($conn, "INSERT INTO device(deviceId,parkName,ownerId) VALUES('$deviceid','$park','$ownerid')");

        if (mysqli_affected_rows($conn) > 0) {
            echo "<script> alert('Device Added Successfully')</script>";
            //add telephone no only if owner is added successfully
            mysqli_query($conn, "INSERT INTO telnumlist(ownerId,tel_num1,tel_num2) values('$ownerid','$tpNum1','$tpNum2')");

        } else {
            echo "<script> alert('Device  not Added')</script>" . $conn->error;
        }

    } else {
        echo "<script> alert('Owner  not Added')</script>" . $conn->error;
    }
}

?>