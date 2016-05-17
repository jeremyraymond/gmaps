function gmapsInitialize(gmapElement) {

    var data = gmapElement.data();

    // parameters from addPoint($lat, $lng, $marker_name) function in Gmaps.php
    // If addPoint is called multiple times, there will be multiple sets of these
    var latitudes = data.latlnglats.trim().split(", ");
    var longitudes = data.latlnglngs.trim().split(", ");
    var markers = data.latlngmarkers.trim().split(", ");
    var info_content = data.latlngcontent.split("***** ");

    // Generate the mapId
    var mapId = data.base_id + data.map_num;

    // For creating the map
    var mapProp = {
        center:new google.maps.LatLng(data.latlngLat1, data.latlngLng1),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    // Create the map
    var map = new google.maps.Map(document.getElementById(mapId),mapProp);

    // Create array of all the latlng objects for use later
    var latlngObjectArray = [];
    // Create array of all the marker objects
    var markerObjectArray = [];
    // Iterate through the multiple sets of points (if more than one)
    for(var i = 0; i < markers.length; i++) {
        var latlngobj;
        // if a latitude and longitude exist for this entry
        if(latitudes[i] && longitudes[i]) {
            //create a latlong object with the lat and lng
            latlngobj = new google.maps.LatLng(latitudes[i], longitudes[i]);
            // if this is NOT a custom marker
            if (!gmapElement.data(markers[i])) {
                markerObjectArray[i] = new google.maps.Marker({
                    position: latlngobj,
                    map: map,
                    optimized: false
                });
            }// end if NOT custom marker
            // If there IS a custom icon
            else {
                // break the marker info up into an array
                var markerData = gmapElement.data(markers[i]).split('|');
                // create icon object
                var image = {
                    url: markerData[0],
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(Math.ceil(markerData[1] / 2), markerData[2]),
                    scaledSize: new google.maps.Size(markerData[1], markerData[2])
                };
                // create marker with custom icon
                markerObjectArray[i] = new google.maps.Marker({
                    position: latlngobj,
                    icon: image,
                    map: map,
                    optimized: false
                });
            } //end else custom marker
            //If there's info window content for this marker
            if(info_content[i].trim()) {
                // Create infowindow object with the corresponding content
                var infowindow = new google.maps.InfoWindow({
                    content: info_content[i]
                });
                // Add the infowindow to the marker
                // Needs an IIFE to carry the variables into the anonymous function
                (function(innermap, innerinfowindow, markerObject) {
                    markerObject.addListener('click', function () {
                        innerinfowindow.open(innermap, markerObject);
                    });
                })(map, infowindow, markerObjectArray[i]);
            }
            latlngObjectArray.push(latlngobj);
        } // end if lat and long exist
    } // end for loop of markers


    // Resize the map in case the size has changed.
    // This is useful for things like accordions and modals
    google.maps.event.trigger(map, 'resize');

    // If two markers exist, set the bounds to focus on them
    if(latlngObjectArray.length > 1) {
        var latlngbounds = new google.maps.LatLngBounds();

        // For every latlng object, extend the bounds to accommodate
        for(var j = 0; j < latlngObjectArray.length; j++) {
            // Set the bounds and auto zoom
            latlngbounds.extend(latlngObjectArray[j]);
        }
        map.fitBounds(latlngbounds);
    }
    // Else one or no map markers exist, center the map on the one that does, or on the United States
    else {
        if(latlngObjectArray[0]) {
            map.setCenter(latlngObjectArray[0]);
            map.setZoom(data.configZoom);
        }
        else {
            map.setCenter(new google.maps.LatLng(41.850033, -87.6500523));
            map.setZoom(3);
        }
    }

}

// Get elements that match class="gmap"
var gmaps = $('.gmap');
if(gmaps.length > 0) {
    // Get the configKey from the data attribute (this will be the same for all of them)
    var configKey = gmaps.data("configKey");
    // Make a synchronized ajax call to get the Google Maps API and return a promise object
    var scriptPromise;
    if(configKey) {
        scriptPromise = $.ajax({
            async: false,
            url: "https://maps.googleapis.com/maps/api/js?key=" + configKey,
            dataType: "script",
            cache: true,
            error: function () {
                console.log("ajax failure");
            }
        });
    }
    else {
        scriptPromise = $.ajax({
            async: false,
            url: "https://maps.googleapis.com/maps/api/js",
            dataType: "script",
            cache: true,
            error: function () {
                console.log("ajax failure");
            }
        });
    }
    // On promise completion, loop through each map element and call the initialize function with data as the param
    scriptPromise.done(function () {
        gmaps.each(function () {
            gmapsInitialize($(this));
        });
    });
    scriptPromise.fail(function () {
        console.log("Google maps API failed to load");
    });
}