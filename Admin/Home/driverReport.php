<html>
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
    <title>Driver Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="script.js"></script>


    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- <link rel="shortcut icon" href="favicon.ico"> -->

    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/icomoon.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/style.css">
    <script src="js/modernizr-2.6.2.min.js"></script>
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->


    <!--  Light Bootstrap Table core CSS    -->
    <link href="css/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"/>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' type='text/css'/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="css/css/pe-icon-7-stroke.css"/>

    <script>
        function showRecord() {
            var str=document.getElementById("deviceId").value;

            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else {
                    // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","driverDetails.php?q="+str,true);
                xmlhttp.send();
            }
        }
    </script>
</head>
<body>

<div class="sidebar" data-color="azure">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text">
                Administration
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="index.php">
                    <i class="pe-7s-home"></i>
                    <p>Home</p>
                </a>
            </li>

            <li>
                <a href="../Login/adminReg.php">
                    <i class="pe-7s-add-user"></i>
                    <p>Register Admin</p>
                </a>
            </li>

            <li>
                <a href="../Login/js/addMap.php">
                    <i class="pe-7s-plus"></i>
                    <p>Add Park</p>
                </a>
            </li>

            <li>
                <a href="../DevReg/devRegUI.php">
                    <i class="pe-7s-plus"></i>
                    <p>Add Device</p>
                </a>
            </li>

            <li>
                <a href="../Login/resetPass.php">
                    <i class="pe-7s-search"></i>
                    <p>Location History</p>
                </a>
            </li>
            <li class="Active">
                <a href="driverReport.php">
                    <i class="pe-7s-search"></i>
                    <p> Device Owner Details</p>
                </a>
            </li>
            <li>
                <a href="../Login/resetPass.php">
                    <i class="pe-7s-key"></i>
                    <p>Change Password</p>
                </a>
            </li>
            <li>
                <a href="../Login/login.php">
                    <i class="pe-7s-power"></i>
                    <p>Log Out</p>
                </a>
            </li>

        </ul>
    </div>
</div>
<div class="main-panel">


    <!-- Loader -->
    <div class="fh5co-loader"></div>

    <div id="wrap">

        <div id="fh5co-page">
            <header id="fh5co-header" role="banner">
                <div class="container">


                    <h7>Animal Tracer For Safari</h7>

                </div>
            </header>
            <!-- Header -->
            <div class="content">
                <div class="container-fluid">
                    <legend><font size="4">View Driver Details</font></legend>
                    <form>

                        <fieldset>
                            <input type="text"  placeholder="Enter Device Id..." pattern="[0-9]{3}DE" title="eg:-150DE"
                                  id="deviceId" name="deviceId" >

                        </fieldset>
                        <br>
                        <button type="button" onclick="showRecord()" name="view" value="view">View Record</button>
                        <div id="txtHint"><b>Person info will be listed here...</b></div>
                    </form>
                </div>
            </div>


    <!-- Slider -->


    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-chevron-down"></i></a>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
        </div>
    </div>
</div>
</body>
</html>

