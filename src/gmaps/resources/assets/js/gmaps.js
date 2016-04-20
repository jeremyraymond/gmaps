
function initialize(data) {

    // For creating Markers
    var latlngobj1 = new google.maps.LatLng(data.latlngLat1, data.latlngLng1);
    var latlngobj2 = new google.maps.LatLng(data.latlngLat2, data.latlngLng2);
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

    // Create the Markers
    var marker1=new google.maps.Marker({
        position:latlngobj1,
        map: map
    });
    var marker2=new google.maps.Marker({
        position:latlngobj2,
        map: map
    });

    // Set the bounds and auto zoom
    var latlngbounds = new google.maps.LatLngBounds();
    latlngbounds.extend(latlngobj1);
    latlngbounds.extend(latlngobj2);

    map.fitBounds(latlngbounds);

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
    error: function() { console.log("ajax failure") }
});
// On promise completion, loop through each map element and call the initialize function with data as the param
scriptPromise.done(function() {

    gmaps.each(function() {
        var data = $(this).data();
        initialize(data)
    });
});
scriptPromise.fail(function(){ console.log("Google maps API failed to load") });
