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

                marker.addListener('click', toggleBounce);
            }
        },
        error: function () {
            alert('Error');
        }
    });


}

function queryDb(duration,animal,park) {
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
    setTimeout(function () {//marker will appear only 30 minute time.
        marker.setMap(null);
        delete marker;
    }, 1000*60*30);
    return marker;


}