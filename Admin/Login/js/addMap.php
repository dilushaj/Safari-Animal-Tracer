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
    <title>Add park</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FREEHTML5.CO"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FREEHTML5.CO"/>

    <link rel="stylesheet" href="../css/style.css">
    <script src="addmap.js"></script>
    <script type="text/javascript" src="jquery.js" id="jq"></script>

    <!-- Replace the value of the key parameter with your own API key. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnd_83H7sRNr3PBi3GyBwAtCL8seHFKso&libraries=places&callback=initMap"
            async defer></script>

</head>

<body>


<div id="map"></div>
<div id="infowindow-content">
    <img src="" width="16" height="16" id="place-icon">
    <span id="place-name" class="title"></span><br>
    <span id="place-address"></span>
</div>
<form>

    <div class="cont">


        <div class="demo ">
            <div class="login">
                <div class="box-header">
                    <div class="h2">Animal Tracer For Safari Drivers</div>
                    <div class="h2">Add Park</div>

                </div>

                <div class="login__form1">
                    <div class="login__row">
                        <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                            <path d="M13.388,9.624h-3.011v-3.01c0-0.208-0.168-0.377-0.376-0.377S9.624,6.405,9.624,6.613v3.01H6.613c-0.208,0-0.376,0.168-0.376,0.376s0.168,0.376,0.376,0.376h3.011v3.01c0,0.208,0.168,0.378,0.376,0.378s0.376-0.17,0.376-0.378v-3.01h3.011c0.207,0,0.377-0.168,0.377-0.376S13.595,9.624,13.388,9.624z M10,1.344c-4.781,0-8.656,3.875-8.656,8.656c0,4.781,3.875,8.656,8.656,8.656c4.781,0,8.656-3.875,8.656-8.656C18.656,5.219,14.781,1.344,10,1.344z M10,17.903c-4.365,0-7.904-3.538-7.904-7.903S5.635,2.096,10,2.096S17.903,5.635,17.903,10S14.365,17.903,10,17.903z"/>
                        </svg>
                        <input type="text" class="login__input name" placeholder="Enter Park" id="place" name="place"/>
                    </div>
                    <br><br><br>

                    <button type="button" onclick="AddPark()" class="login__submit">Confirm Park</button>

                </div>

            </div>


        </div>
    </div>



</body>

</html>
