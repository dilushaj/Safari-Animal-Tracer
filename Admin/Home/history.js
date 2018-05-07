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
}

//initially set the map
function setMap(park) {
    $.ajax({
        type: 'GET',
        url: 'setPark.php?park=' + park,
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

            }
        },
        error: function () {
            alert('Error');
        },
    });


}

function queryDb(duration, animal, park) {
    $.ajax({
        type: 'GET',
        url: 'showPopup.php?duration=' + duration + '&park=' + park + '&animal=' + animal,
        dataType: 'json',
        success: function (result) {
            var courses = result;
            for (var i = 0; i < courses.length; i++) {
                var animal = courses[i].animalName;
                var longitude = parseFloat(courses[i].longitude);
                var latitude = parseFloat(courses[i].latitude);
                var position = {lat: latitude, lng: longitude};
                makeMarker(animal, position);

            }
        }
    });


}

function makeMarker(animal, position) {

    var icon = "";
    if (animal == "elephant") {
        icon = "images/elephant.png";
    } else if (animal == "lion") {
        icon = "images/lion.png";
    } else if (animal == "tiger") {
        icon = "images/tiger.png";
    } else if (animal == "wolf") {
        icon = "images/wolf.png";
    } else if (animal == "fox") {
        icon = "images/fox.png";
    } else if (animal == "bear") {
        icon = "images/bear.png";
    }else if (animal == "deer") {
        icon = "images/deer.png";
    } else if (animal == "crocodile") {
        icon = "images/crocodile.png";
    } else if (animal == "peacock") {
        icon = "images/peacock.png";

    }

    var iconBase="images/base.png";
     new google.maps.Marker({
        position: position,
        map: map,
        animation: google.maps.Animation.DROP,
        icon:{
            url: icon,
            scaledSize: new google.maps.Size(28, 28),

        }
    });


}