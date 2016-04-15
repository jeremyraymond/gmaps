<?php namespace Gmaps\Facades;

use Illuminate\Support\Facades\Facade;

class GmapsFacade extends Facade {

    protected static function getFacadeAccessor() { return 'gmaps'; }

}