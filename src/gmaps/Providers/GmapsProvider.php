<?php namespace Gmaps\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Gmaps\Gmaps;
use Illuminate\View;

class GmapsProvider extends ServiceProvider {

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the view file
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gmaps');

        // Running 'php artisan vendor:publish' will publish the view and config files to the application for app-specific editing by the dev
        $this->publishes([
            __DIR__.'/../config/gmapsconfig.php' => $this->app->basePath() . '/config/gmapsconfig.php',
            __DIR__.'/../resources/assets/js/gmaps.js' => $this->app->basePath() . '/resources/assets/scripts/partials/gmaps.js',

        ]);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('gmaps', function() {
            return new Gmaps(config('gmapsconfig'));
        });

    }

}
