<?php

namespace Gmaps;

use View;

class Gmaps
{
    public function __construct() {
        dd("asdf");
    }
    public function render() {
        return View::make('gmaps')->render();
    }
}