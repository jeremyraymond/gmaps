<?php namespace Gmaps\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class GmapsProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadViewsFrom(__DIR__.'/path/to/views', 'gmaps');
        dd(__DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }

}
