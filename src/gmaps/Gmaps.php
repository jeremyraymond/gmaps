<?php

namespace Gmaps;

use View;

class Gmaps
{
    private $data = [];
    private $latlng1 = [];
    private $latlng2 = [];
    
    public function __construct($config) {
        // Get config data and assign it to $data
        $this->data['config'] = $config;
        $this->latlng1 = ['lat1' => '', 'lng1' => ''];
        $this->latlng2 = ['lat2' => '', 'lng2' => ''];
    }

    public function setOrigin($lat, $lng) {
        $this->latlng1['lat1'] = $lat;
        $this->latlng1['lng1'] = $lng;
    }

    public function setDestination($lat, $lng) {
        $this->latlng2['lat2'] = $lat;
        $this->latlng2['lng2'] = $lng;
    }

    // Return the html rendered from gmaps.blade.php with the $data array
    public function render($map_num = 1) {
        
        $this->data['latlng'] = array_merge($this->latlng1, $this->latlng2);
        $this->data['map_num'] = $map_num;

        return View::make('gmaps::gmaps')->with($this->data)->render();
    }
}