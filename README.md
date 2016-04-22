
#Gmaps
The Google Maps Laravel package built for Insite

##How to Install
###Composer.json
Add the following entry to your 'repositories' array

    "repositories": [
           {
                "type": "vcs",
                "url": "https://github.com/SpartanNash/insitement"
            },
           {
                "type": "vcs",
                "url": "https://github.com/jeremyraymond/gmaps"
           }],
Then run **composer install** or **composer update** while in the root directory of your project in the terminal.

###Vendor Publish
Once the package has been installed through composer, run the command **php artisan vendor:publish** in your terminal. This will publish the config file **gmapsconfig.php** to your **/app/config/** folder. Here you can customize the configuration options. It will also publish the gmaps.js file to the **/resources/assets/scripts/partials/** folder. In an Insite project, when **gulp** or **gulp watch** is run, this folder gets automatically compiled into the *projectname*.min.js file in the **/public/assets/js/** folder.

###Edit app.php
Edit the **/config/app.php**

* Add the following entry to the **'providers'** array:
**Gmaps\Providers\GmapsProvider::class**
* Add the following entry to the **'aliases'** array:
**'Gmaps'     => Gmaps\Facades\GmapsFacade::class**

###Edit gmapsconfig.php
Now take a look at the **/config/gmapsconfig.php** file and edit the options as necessary:

* **'key' -** The Google Maps API key
* **'base_id -** The **id** that gets used on the Gmaps container <div>. The map number gets appended to this. Fore example, if this value is **'map'**, then the id of the first listed map on the page would be **id="map1"**.
* **'home_marker' -** The filepath or url to the image that should replace the default icon for the marker on the map for the first set of coordinates.
* **'dest_marker' -** Same as **home_marker** except replaces the icon for the destination marker.