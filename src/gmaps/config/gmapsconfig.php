<?php

return array(

    'key'           => env('GOOGLE_API_KEY', 'AIzaSyAtqWsq5Ai3GYv6dSa6311tZiYKlbYT4mw'), // API key that gets tagged onto the script url
    'base_id'       => env('BASE_ID', 'map'),  // The base id for the container div that the map number gets tagged onto
    'home_marker'   => env('HOME_MARKER', ''), // The marker used for the origin latlng
    'dest_marker'   => env('DEST_MARKER', '')  // The marker used for the destination latlng

);