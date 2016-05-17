<?php

namespace Gmaps;

use View;

class Gmaps
{
    private $data = [];
    private $latlngArray = [];
    
    public function __construct($config) {
        // Get config data and assign it to $data
        $this->data['config'] = $config;
        $this->data['latlngArray'] = [];
    }

    public function addPoint($lat, $lng, $marker_name = 'none', $info = '') {
        if(!empty($lat) && !empty($lng))
            array_push($this->latlngArray, ['lat' => $lat, 'lng' => $lng, 'marker_name' => $marker_name, 'info_content' => $info]);
    }

    public function addMultiplePoints($latlngArray) {
        array_push($this->latlngArray, $latlngArray);
    }

    // Return the html rendered from gmaps.blade.php with the $data array
    public function render($map_num = 1) {
        $this->data['map_num'] = $map_num;
        $this->data['latlngArray'] = $this->latlngArray;
        $this->latlngArray = [];
        return View::make('gmaps::gmaps')->with($this->data)->render();
    }
}