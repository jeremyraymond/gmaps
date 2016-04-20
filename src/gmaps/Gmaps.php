<?php

namespace Gmaps;

use View;

class Gmaps
{
    private $data = [];
    
    public function __construct($config) {
        // Get config data and assign it to $data
        $this->data['config'] = $config;
    }

    // Return the html rendered from gmaps.blade.php with the $data array
    public function render($latlng, $map_num) {

        $this->data['latlng'] = $latlng;
        $this->data['map_num'] = $map_num;

        return View::make('gmaps::gmaps')->with($this->data)->render();
    }
}