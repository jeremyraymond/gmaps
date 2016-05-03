<?php

namespace Gmaps;

use View;

class Gmaps
{
    private $data = [];
    
    public function __construct($config) {
        // Get config data and assign it to $data
        $this->data['config'] = $config;
        $this->data['latlngArray'] = [];
    }

    public function addPoint($lat, $lng, $marker_name = 'none') {
        array_push($this->data['latlngArray'], ['lat' => $lat, 'lng' => $lng, 'marker_name' => $marker_name]);
    }

    public function addMultiplePoints($latlngArray) {
        array_push($this->data['latlngArray'], $latlngArray);
    }

//    public function setOrigin($lat, $lng) {
//        $this->data['latlngOrigin']['lat'] = $lat;
//        $this->data['latlngOrigin']['lng'] = $lng;
//    }
//
//    public function setEnRoute($lat, $lng) {
//        $this->data['latlngEnRoute']['lat'] = $lat;
//        $this->data['latlngEnRoute']['lng'] = $lng;
//    }
//
//    public function setDestination($lat, $lng) {
//        $this->data['latlngDest']['lat'] = $lat;
//        $this->data['latlngDest']['lng'] = $lng;
//    }

    // Return the html rendered from gmaps.blade.php with the $data array
    public function render($map_num = 1) {
        $this->data['map_num'] = $map_num;
        return View::make('gmaps::gmaps')->with($this->data)->render();
    }
}