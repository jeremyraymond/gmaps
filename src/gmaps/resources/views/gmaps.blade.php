<script src="https://maps.googleapis.com/maps/api/js?{{ $config['key'] }}"></script>
<script>
    function initialize() {
        // For creating the map object
        var latlng1 = {lat: {{ $lat1 }}, long: {{ $long1 }}};
        var latlng2 = {lat: {{ $lat2 }}, long: {{ $long2 }}};
        // For creating Markers
        var latlngobj1 = new google.maps.LatLng(latlng1.lat, latlng1.long);
        var latlngobj2 = new google.maps.LatLng(latlng2.lat, latlng2.long);

        // For creating the map
        var mapProp = {
        center:new google.maps.LatLng(latlng1.lat, latlng1.long),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("map"),mapProp);

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