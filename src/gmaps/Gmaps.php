<?php

namespace Gmaps;

use View;

class Gmaps
{
    private $data = [];
    
    public function __construct($config) {

        $this->data['config'] = $config;
    }
    public function render($lat1, $long1, $lat2, $long2) {

        $this->data['lat1'] = $lat1;
        $this->data['long1'] = $long1;
        $this->data['lat2'] = $lat2;
        $this->data['long2'] = $long2;

        return View::make('gmaps::gmaps')->with($this->data)->render();
    }
}