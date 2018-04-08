<?php
include '../../dbCon.php';
session_start();

?>

    <!--[if lt IE 7]>
    <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>
    <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>
    <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!-->
    <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Change Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
        <meta name="keywords"
              content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
        <meta name="author" content="FREEHTML5.CO"/>

        <link rel="stylesheet" href="css/style.css">


    </head>

    <body>
    <form action="resetPass.php" method="post">

        <div class="cont">


            <div class="demo ">
                <div class="login">
                    <div class="box-header">
                        <div class="h2">Change Password</div>

                    </div>

                    <div class="login__form1">
                        <div class="login__row">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0"/>
                            </svg>
                            <input type="password" class="login__input name" placeholder="Current Password"
                                   name="currentPass"/>
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0"/>
                            </svg>
                            <input type="password" class="login__input pass" placeholder="New Password"
                                   name="newPassword"/>
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0"/>
                            </svg>
                            <input type="password" class="login__input pass" placeholder="Confirm Password"
                                   name="confPassword"/>
                        </div>
                        <button type="submit" class="login__submit">Change Password</button>

                    </div>

                </div>


            </div>
        </div>


    </form>
    </body>

    </html>
<?php
if ((isset($_POST["currentPass"])) && (isset($_POST["newPassword"])) && (isset($_POST["confPassword"]))) {

    include '../../dbCon.php';
    $user = $_SESSION['username'];

    if (!get_magic_quotes_gpc()) {

        $currentPass = addslashes($_POST["currentPass"]);
        $newPassword = addslashes($_POST["newPassword"]);
        $confPassword = addslashes($_POST["confPassword"]);
    } else {
        $currentPass = $_POST["currentPass"];
        $newPassword = $_POST["newPassword"];
        $confPassword = $_POST["confPassword"];
    }
    echo "<br>";
    $password = "";
    $currentPass1 = md5($currentPass);
    $sql = "Select Password FROM admin where UserName='" . $user . "'";
    if ($is_query_run = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_array($is_query_run, MYSQL_ASSOC)) {
            $password = $row['Password'];
        }
    }
    if ($currentPass1 == $password) {
        if ($newPassword == $confPassword) {
            $newPass = md5($newPassword);
            $sql1 = "UPDATE admin SET Password='$newPass' WHERE UserName='" . $user . "'";
            mysqli_query($conn, $sql1);
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script> alert('Password Updated successfully')</script>";
            } else {

                echo "<script> alert('Error occurred')</script>";
            }

        } else {
            echo "<script> alert('error- new Password and confirm password mismatch')</script>";
            echo "<script> window.history.go(-1);</script>";

        }


    } else {
        echo "<script> alert('error-Incorrect Current Password')</script>";
        echo "<script> window.history.go(-1);</script>";
    }


}


?>