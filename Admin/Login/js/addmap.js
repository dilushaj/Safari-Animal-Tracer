var longitude=0 ;
var latitude =0;
var park1 = "";


function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 7.8731, lng: 80.7718},
        zoom: 8
    });

    var input = document.getElementById('place');
    var autocomplete = new google.maps.places.Autocomplete(input);

    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function () {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
            map.setZoom(8);
        } else {

            map.setCenter(place.geometry.location);
            map.setZoom(8);
        }
        marker.setPosition(place.geometry.location);
        park1 = place.name;

        marker.setVisible(true);

      // window.alert(park);

        //position1 = JSON.stringify(place.geometry.location);//string json
        var object=place.geometry.location
        latitude= object.lat();
        longitude=object.lng();


        //var obj  = JSON.parse(position);
        //window.alert(position);
        // var key1="lat";
        // window.alert(position[key1]);
        //window.alert(toplace.geometry.location[0]['lat']);
        //latitude=place.geometry.location[0];
        //longitude=place.geometry.location[1];


        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }

        infowindowContent.children['place-icon'].src = place.icon;
        infowindowContent.children['place-name'].textContent = place.name;
        infowindowContent.children['place-address'].textContent = address;
        infowindow.open(map, marker);
    });

    autocomplete.setTypes([]);

}

function AddPark() {
        var park=park1;
        $.ajax({
            type: 'Get',
            url: 'addpark.php?park=' + park + '&longitude=' + longitude + '&latitude=' + latitude,
            success: function () {
                alert('Park added succesfully');
            },
            error: function(){
                alert('Park Not added');
            }
        });
}


/*$.ajax({
    type: 'Get',
    url: 'localDatabaseAccess.php?latitude=' + latitude + '&longitude=' + longitude + '&animal=' + animal + '&broadcasted=' + "broadcasted",
    success: function () {
        alert('Data saved to Local Database successfully');
    }
});*/