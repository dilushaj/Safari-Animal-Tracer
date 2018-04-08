var map;
var marker;
var coordinates = [];
var marker1;

//load google map
function initMap() {
    var uluru = {lat: 7.8731, lng: 80.7718};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: uluru
    });

    setMap();

}

function setMap() {
   // var longitude = 0;
   // var latitude = 0;
    $.ajax({
        type: 'POST',
        url: 'setPark.php?',
        //dataType: 'json',
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

//get the GPS reading
function setCoordinates() {
    var latitude = Number(document.getElementById("text-box1").value);//should read from the GPS receiver
    var longitude = Number(document.getElementById("text-box2").value);
    coordinates = [latitude, longitude];
    var latlng = {lat: latitude, lng: longitude};
    marker1 = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: "icons/currentLocation.png"
    });
    setInterval(changeMarkerPosition, 200);
}


function changeMarkerPosition() {//changing the position of the marker with time.
    var latlng = getCoordinates();
    var latitude = latlng[0] + 0.0001;
    var longitude = latlng[1] + 0.0001;
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
   // var latlng = getCoordinates();
   // var position = {lat: latlng[0], lng: latlng[1]};
    connectionAvailable(animal);


}

//send data to the databases according to the connection
function connectionAvailable(animal) {
    var latlng = getCoordinates();
    var latitude = latlng[0];
    var longitude = latlng[1];

    if (navigator.onLine) {
        alert("Device is online");
        $.ajax({
            type: 'Get',
            url: 'localDatabaseAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "broadcasted",
            success: function () {
                alert('Data saved to Local Database successfully');
            }
        });
        $.ajax({
            type: 'Get',
            url: 'webServerAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal,
            success: function () {
                alert('Data saved to web Server successfully');
            }
        });

    } else {
        alert("Device is offline");
        $.ajax({
            type: 'Get',
            url: 'localDatabaseAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "not broadcasted",
            success: function () {
                alert('Data saved to Local Database successfully');
            }
        });
    }
}

function localDbQuery() {
    setInterval(queryDb, 3000);

}

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
        icon = "icons/bear.png"

    }

      var marker= new google.maps.Marker({
            position: position,
            map: map,
            animation: google.maps.Animation.DROP,
            icon: icon
        });
        setTimeout(function () {
            marker.setMap(null);
            delete marker;
        }, 5000);
        return marker;


}
function broadCast(){
    alert('Hello Dilusha')

}

function test(){}


