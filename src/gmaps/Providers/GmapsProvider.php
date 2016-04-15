<?php namespace Gmaps\Providers;

use Illuminate\Support\ServiceProvider;
use App;
use Gmaps;

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
            __DIR__.'/../config/gmapsconfig.php' => $this->app->basePath() . '/app/config/gmapsconfig.php',
        ]);

        // Merges the config file from the package folder with the one in the app folder so the dev can pick and choose which options to override
        $this->mergeConfigFrom(
            __DIR__.'/../config/gmapsconfig.php', 'gmapsconfig'
        );

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('gmaps', function() {
            return new Gmaps();
        });

    }

}
