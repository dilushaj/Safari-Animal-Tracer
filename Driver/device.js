var map;
var marker;
var coordinates = [];
var marker1;

//load google map
function initMap() {
    var uluru = {lat: 7.8731, lng: 80.7718};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: uluru
    });

    setMap();

}
//initially set the map
function setMap() {

    $.ajax({
        type: 'POST',
        url: 'setPark.php?',
        success: function (result) {

            var courses = JSON.parse(result);
            for (var i = 0; i < courses.length; i++) {
                var longitude = Number(courses[i].longitude);
                var latitude = Number(courses[i].latitude);
                var position = {lat: latitude, lng: longitude};
                map.setCenter(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map
                });

                marker.addListener('click', toggleBounce);
            }
        },
        error: function () {
            alert('Error');
        }
    });


}

//add animation to marker
function toggleBounce() {
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}


function gpsReader(){
    $.ajax({
        type: "GET",
        async: false,
        url: 'GPS',
        success: function(txt){
            var lines = txt.split("\n");
            var line=lines[lines.length-1].split(",");
            var latitude=Number(line[0]);
            var longitude=Number(line[1]);
            coordinates=[latitude, longitude];
        }
    });
    return coordinates;
}


//Setting the initial GPS reading value
function setCoordinates() {
    var coords=gpsReader();
    var latitude =coords[0];
    var longitude = coords[1];
    coordinates = [latitude, longitude];
    var latlng = {lat: latitude, lng: longitude};
    marker1 = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: "icons/currentLocation.png"
    });
    setInterval(changeMarkerPosition, 200);
}


//get the current location of safari
function changeMarkerPosition() {//changing the position of the marker with time.
    var latlng = getCoordinates();//gpsReader();--------------------------------------------------------------------------------------
    var latitude = Math.round((latlng[0] + 0.00001) * 100000) / 100000;//get the reading from GPS reciever upto 4 digits
    var longitude = Math.round((latlng[1] + 0.00001) * 100000) / 100000;
    coordinates = [latitude, longitude];
    var position = new google.maps.LatLng(latitude, longitude);
    marker1.setPosition(position);

}

//return coordinates
function getCoordinates() {
    return coordinates;
}

//make animal popup
function animalInvoke(animal) {
    connectionAvailable(animal);


}

//send data to the databases according to the connection
function connectionAvailable(animal) {
    var latlng = getCoordinates();//gpsReader()-------------------------------------------------------------------------------------

    var latitude = latlng[0];
    var longitude = latlng[1];

    if (navigator.onLine) {
        //alert("Device is online");
        $.ajax({
            type: 'Get',
            url: 'localDatabaseAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "broadcasted",
            /*success: function () {
                alert('Data saved to Local Database successfully');
            }*/
        });
        $.ajax({
            type: 'Get',
            url: 'webServerAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal,
            /*success: function () {
                alert('Data saved to web Server successfully');
            }*/
        });

    } else {
        //alert("Device is offline");
        $.ajax({
            type: 'Get',
            url: 'localDatabaseAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "not broadcasted",
            /*success: function () {
                alert('Data saved to Local Database successfully');
            }*/
        });
    }
}
//query local database once per 3 seconds
function localDbQuery() {
    setInterval(queryDb, 3000);

}
//make animal popups
function queryDb() {
    $.ajax({
        type: 'POST',
        url: 'showPopup.php?',
        dataType: 'json',
        success: function (result) {

            var courses = result;
            for (var i = 0; i < courses.length; i++) {
                var animal = courses[i].animalName;
                var longitude = courses[i].longitude;
                var latitude = courses[i].latitude;
                var position = {lat: latitude, lng: longitude};

                makeMarker(animal, position);


            }
        }
    });


}

function makeMarker(animal, position) {
    var icon = "";
    if (animal == "elephant") {
        icon = "icons/elephant.png";
    } else if (animal == "lion") {
        icon = "icons/lion.png";
    } else if (animal == "tiger") {
        icon = "icons/tiger.png";
    } else if (animal == "wolf") {
        icon = "icons/wolf.png";
    } else if (animal == "fox") {
        icon = "icons/fox.png";
    } else if (animal == "bear") {
        icon = "icons/bear.png";
    }else if (animal == "deer") {
        icon = "icons/deer.png";
    } else if (animal == "crocodile") {
        icon = "icons/crocodile.png";
    } else if (animal == "peacock") {
        icon = "icons/peacock.png";

    }

    var marker= new google.maps.Marker({
        position: position,
        map: map,
        animation: google.maps.Animation.DROP,
        icon:{
            url: icon,
            scaledSize: new google.maps.Size(28, 28)

        }
    });
    setTimeout(function () {//marker will appear only 30 minute time.
        marker.setMap(null);
        delete marker;
    }, 1000*60*30);
    return marker;


}
function broadCast() {
    if (navigator.onLine) {
        setInterval(push, 30000);
        setInterval(poll, 30000);
    }
}
function push(){
    $.ajax({
        type: 'Get',
        url: 'broadcast.php?',
        /*success: function (){
           alert('broadcasted successfully');
        }*/
    });
}


function poll(){
    $.ajax({
        type: 'Get',
        url: 'polling.php?',
        /*success: function (){
            alert('polled successfully');
        }*/
    });
}
function refresh(){
    $.ajax({
        type: 'Get',
        url: 'refresh.php?',
        /*success: function (){
            alert('refresh successfully');
        }*/
    });
}
function hostAvailable(){
    //establish wifi connection
    send();
    recieve();
}
function send(){
    $.ajax({
        type: 'POST',
        url: 'peerShare.php?',
        dataType: 'json',
        success: function (result) {
            var courses = JSON.stringify(result);//send this string



        }

    });


}

function recieve(result){//recieve this string
    var courses = JSON.parse(result);
    for (var i = 0; i < courses.length; i++) {
        var animal = courses[i].animalName;
        var longitude = courses[i].longitude;
        var latitude = courses[i].latitude;
        var broadcast= courses[i].globalStatus;
        var time=courses[i].time;
        $.ajax({
            type: 'Get',
            url: 'peerRecieve.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + broadcast + '$time=' + time,
        });
    }


}



