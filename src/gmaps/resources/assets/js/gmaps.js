
function gmapsInitialize(data) {

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

    // Attach the map object to the data on the element so other js files can use it
    $('#' + mapId).data("mapObject", map);

    // If the origin set of coordinates exist, set the marker
    var marker1;
    var latlngobj1;
    if(data.latlngLat1 && data.latlngLng1) {
        latlngobj1 = new google.maps.LatLng(data.latlngLat1, data.latlngLng1);
        // If no custom icon is specified for origin (home) marker
        if (!data.configOrigin_marker_url) {
            marker1 = new google.maps.Marker({
                position: latlngobj1,
                map: map
            });
        }
        // If there is a custom icon specified in the configs for origin (home) marker
        else {
            console.log(data.configOrigin_marker_url + " " + Math.ceil(data.configOrigin_marker_horiz_size / 2) + " " + data.configOrigin_marker_vert_size);
            var image = {
                url: data.configOrigin_marker_url,
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(Math.ceil(data.configOrigin_marker_horiz_size / 2), data.configOrigin_marker_vert_size),
                scaledSize: new google.maps.Size(data.configOrigin_marker_horiz_size, data.configOrigin_marker_vert_size)
            };

            marker1 = new google.maps.Marker({
                position: latlngobj1,
                icon: image,
                map: map
            });
        }
    } // endif

    // If the destination set of coordinates exist, set the marker
    var marker2;
    var latlngobj2;
    if(data.latlngLat2 && data.latlngLng2) {
        latlngobj2 = new google.maps.LatLng(data.latlngLat2, data.latlngLng2);
        // If no custom icon is specified for destination marker
        if (!data.configDest_marker_url) {
            marker2 = new google.maps.Marker({
                position: latlngobj2,
                map: map
            });
        }
        // If there is a custom icon specified in the configs for destination marker
        else {

            var image2 = {
                url: data.configDest_marker_url,
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(Math.ceil(data.configDest_marker_horiz_size / 2), data.configDest_marker_vert_size), // The anchor point will automatically be placed at the center of the bottom of the image
                scaledSize: new google.maps.Size(data.configDest_marker_horiz_size, data.configDest_marker_vert_size)
            };

            marker2 = new google.maps.Marker({
                position: latlngobj2,
                icon: image2,
                map: map
            });
        }
    }
    // Resize the map in case the size has changed.
    // This is useful for things like accordions and modals
    google.maps.event.trigger(map, 'resize');

    // If two markers exist, set the bounds to focus on them
    if(latlngobj1 && latlngobj2) {
        // Set the bounds and auto zoom
        var latlngbounds = new google.maps.LatLngBounds();
        latlngbounds.extend(latlngobj1);
        latlngbounds.extend(latlngobj2);

        map.fitBounds(latlngbounds);
    }
    // Else one or no map markers exist, center the map on the one that does, or on the United States
    else {
        if(latlngobj1) {
            map.setCenter(marker1.getPosition());
        }
        else if(latlngobj2) {
            map.setCenter(latlngobj2);
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
// Get the configKey from the data attribute (this will be the same for all of them)
var configKey = gmaps.data( "configKey" );
// Make a synchronized ajax call to get the Google Maps API and return a promise object
var scriptPromise = $.ajax({
    async: false,
    url: "https://maps.googleapis.com/maps/api/js?key=" + configKey,
    dataType: "script",
    cache: true,
    error: function() { console.log("ajax failure"); }
});
// On promise completion, loop through each map element and call the initialize function with data as the param
scriptPromise.done(function() {

    gmaps.each(function() {
        var data = $(this).data();
        gmapsInitialize(data);
    });
});
scriptPromise.fail(function(){ console.log("Google maps API failed to load"); });
