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
    <title>Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

    <link rel="stylesheet" href="css/style.css">


</head>

<body>
<form action="adminReg.php" method="post">

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Animal Tracer For Safari Drivers</div>
                    <div class="h2">Register Admin</div>

                </div>

                <div class="login__form1">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8"/>
                        </svg>
                        <input type="text" class="login__input name" placeholder="UserId" name="username"
                               pattern="[0-9]{6}[A-Z]" title="eg:-123456A"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0"/>
                        </svg>
                        <input type="password" class="login__input pass" placeholder="Password" name="password"/>
                    </div>
                    <div class="login__row">
                        <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                            <path d="M17.051,3.302H2.949c-0.866,0-1.567,0.702-1.567,1.567v10.184c0,0.865,0.701,1.568,1.567,1.568h14.102c0.865,0,1.566-0.703,1.566-1.568V4.869C18.617,4.003,17.916,3.302,17.051,3.302z M17.834,15.053c0,0.434-0.35,0.783-0.783,0.783H2.949c-0.433,0-0.784-0.35-0.784-0.783V4.869c0-0.433,0.351-0.784,0.784-0.784h14.102c0.434,0,0.783,0.351,0.783,0.784V15.053zM15.877,5.362L10,9.179L4.123,5.362C3.941,5.245,3.699,5.296,3.581,5.477C3.463,5.659,3.515,5.901,3.696,6.019L9.61,9.86C9.732,9.939,9.879,9.935,10,9.874c0.121,0.062,0.268,0.065,0.39-0.014l5.915-3.841c0.18-0.118,0.232-0.36,0.115-0.542C16.301,5.296,16.059,5.245,15.877,5.362z"/>
                        </svg>
                        <input type="text" class="login__input pass" placeholder="Email" name="email"
                               pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="eg:-123@gmail.com">
                    </div>

                    <button type="submit" class="login__submit">Register Admin</button>

                </div>

            </div>


        </div>
    </div>


</form>
</body>

</html>
<?php
include '../../dbCon.php';

function length($inputtxt, $length)
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

$errors = "";
// create a variable
if ((isset($_POST["username"])) && (isset($_POST["password"])) && (isset($_POST["email"]))) {
    if (empty(test_input($_POST['username']))) {
        $errors = "error-complete all fields";
        echo "<script> alert('error-complete Username')</script>";
        echo "<script> window.history.go(-1);</script>";
    } else {
        $username = $_POST['username'];
    }

    if (test_input(empty($_POST['password']))) {
        $errors = "error-complete all fields";
        echo "<script> alert('error-complete Password')</script>";
        echo "<script> window.history.go(-1);</script>";
    } else {
        $password = md5($_POST['password']);
    }


    if (test_input(empty($_POST['email']))) {
        $errors = "error-complete all fields";
        echo "<script> alert('error-complete email')</script>";
        echo "<script> window.history.go(-1);</script>";
    } else {//---------------------------------------------------------------------------
        $email1 = $_POST['email'];
        $request = file_get_contents("http://emailapi.com/api/8dc8bb4f/$email1");//json object returned as a string
        $result = json_decode($request, true);
        if ($result['data']['status'] == "1") {
            $email = $_POST['email'];
        } else {
            $errors = "error-Invalid email";
            echo "<script> alert('error-Invalid email')</script>";
            echo "<script> window.history.go(-1);</script>";
        }
    }


    if ($errors == "") {
        mysqli_query($conn, "INSERT INTO admin(UserName,Password,Email,Type)
				VALUES('$username','$password','$email','subAdmin')");


        if (mysqli_affected_rows($conn) >= 1) {
            echo "<script> alert('Admin registered successfully')</script>";
        } else {
            echo "<script> alert('Admin not added- Duplicate Field')</script>";

        }
    }
}
?>
