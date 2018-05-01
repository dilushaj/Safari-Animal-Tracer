
<!DOCTYPE html>


<head>
    <script type= "text/javascript" src="jquery.js" id="jq"></script>
     <script src="history.js"></script>

    <script sync defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnd_83H7sRNr3PBi3GyBwAtCL8seHFKso&callback=initMap">
    </script>
    <script>
        <?php
        $park=$_POST['park'];
        $animal=$_POST['animal'];
        $duration=$_POST['duration'];

        ?>
        var park = <?php echo(json_encode($park));?>;
        var animal = <?php echo(json_encode($animal));?>;
        var duration= <?php echo(json_encode($duration));?>;


        setMap(park);
        queryDb(duration,animal,park);
        </script>


    <!-- CSS -->
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'>
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oleo+Script:400,700'>
    <link rel="stylesheet" href="../DevReg/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../DevReg/assets/css/style.css">


    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>


</head>
<body>

<div class="header">
    <div class="container">
        <div class="row">
            <div class="logo span4">
                <h1><a href="">Location Report<span class="green">.</span></a></h1>
            </div>
            <div class="links span8">
                <a class="home" href="../Home/index.html" rel="tooltip" data-placement="bottom" data-original-title="Home"></a>
                <a class="logout" href="../Login/login.php" rel="tooltip" data-placement="bottom" data-original-title="Logout"></a>
            </div>
        </div>
    </div>
</div>
<div id="map"></div>
</body>
<!-- Javascript -->
<script src="../DevReg/assets/js/jquery-1.8.2.min.js"></script>
<script src="../DevReg/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../DevReg/assets/js/jquery.backstretch.min.js"></script>
<script src="../DevReg/assets/js/scripts.js"></script>
</html>
