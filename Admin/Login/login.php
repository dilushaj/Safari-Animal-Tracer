<html lang="en">
<!--[if lt IE 7]>      <!--html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <!--html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <!--html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <!--html class="no-js"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Animal Tracer-Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
<form action="login.php" method="post">

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Animal Tracer For Safari Drivers</div>
                    <div class="h2">Login Form</div>

                </div>
                <div class="login__check"></div>
                <div class="login__form">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8"/>
                        </svg>
                        <input type="text" class="login__input name" placeholder="Username" name="username"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0"/>
                        </svg>
                        <input type="password" class="login__input pass" placeholder="Password" name="password"/>
                    </div>
                    <button type="submit" class="login__submit">Sign in</button>
                    <!--p class="login__signup"><a href="resetPass.php">Reset Password</a></p-->
                </div>

            </div>


        </div>
    </div>


</form>
</body>

</html>
<?php

if ((isset($_POST["username"])) && (isset($_POST["password"]))) {

    include '../../dbCon.php';


    $new_username = $_POST["username"];
    $new_password1 = $_POST["password"];


    echo "<br>";

    $new_password = md5($new_password1);
    session_start();
    $_SESSION['username'] = $new_username;

    $query = "SELECT * FROM admin WHERE UserName='" . $new_username . "'";

    if ($is_query_run = mysqli_query($conn, $query)) {

        while ($row = mysqli_fetch_array($is_query_run, MYSQLI_ASSOC)) {
            if ($new_password == $row['Password']) {

                $_SESSION['username'] = $new_username;
                if($row['Type']=="admin"){
                    header("location: ../Home/index.php");
                }else {
                    header("location: ../Home/index1.php");
                }
            } else {
                echo "<script> alert('Username and  Password miss match')</script>";
            }
        }
    }


}
?>