<?php

return array(

    'key'           => env('GOOGLE_API_KEY', 'AIzaSyAtqWsq5Ai3GYv6dSa6311tZiYKlbYT4mw'), // API key that gets tagged onto the script url
    'base_id'       => env('BASE_ID', 'map'),           // The base id for the container div that the map number gets tagged onto
    'zoom'          => env('ZOOM', '8'),                // The zoom level for when it just displays one marker

    // This is where you tell the package the location and size of your custom markers. This array makes the custom markers available
    // for assignment with the 3rd parameter of addPoint. Only customize the second level of this array, the 1st and 3rd levels are
    // mandatory and used by the javascript.

    /*
    'markers' => [
        // Custom marker name that lines up with 3rd parameter of addPoint($lat, $lng, $marker_name)
        'origin' => [
            'url'           =>      env( 'INSITE_CDN', 'https://cdn.spartannash.com/insite/deliveries/' ) . 'assets/img/map-icon-warehouse.svg',    // Url for the marker image
            'horiz_size'    =>      '29',                                   // Desired horizontal size of the image in pixels
            'vert_size'     =>      '45'                                    // Desired vertical size of the image in pixels
        ],
        'enroute' => [
            'url'           =>      env( 'INSITE_CDN', 'https://cdn.spartannash.com/insite/deliveries/' ) . 'assets/img/map-icon-truck.svg',
            'horiz_size'    =>      '29',
            'vert_size'     =>      '45'
        ],
        'destination' => [
            'url'           =>      env( 'INSITE_CDN', 'https://cdn.spartannash.com/insite/deliveries/' ) . 'assets/img/map-icon-store.svg',
            'horiz_size'    =>      '29',
            'vert_size'     =>      '45'
        ]
    ],
    */

);