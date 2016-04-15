<script>
    function initialize() {
        // For creating the map object
        // http://maps.googleapis.com/maps/api/js?AIzaSyAtqWsq5Ai3GYv6dSa6311tZiYKlbYT4mw
        var latlng1 = {lat: 42.825551, long: -85.6868027};
        var latlng2 = {lat: 42.9634498, long: -85.6706894};

        // For creating Markers
        var latlngobj1 = new google.maps.LatLng(latlng1.lat, latlng1.long);
        var latlngobj2 = new google.maps.LatLng(latlng2.lat, latlng2.long);

        // For creating the map
        var mapProp = {
        center:new google.maps.LatLng(latlng1.lat, latlng1.long),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

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
    google.maps.event.addDomListener(window, 'load', initialize);
</script>