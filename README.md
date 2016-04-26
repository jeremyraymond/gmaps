#Gmaps
The Google Maps Laravel package built for Insite. Currently most ideal for situations where you have **two pairs of coordinates** (home and destination) *or* a **single pair of coordinates** to be placed on **one or more maps** displayed on a **single page**.

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

##How to Use
###Import Namespace
Place ``use Gmaps;`` at the top of your controller (or wherever you are using the class.

###Set Origin and/or Destination
You can use either function if you only have one point of interest (depending on the icon you would like displayed, which was set in the gmapsconfig.php file). Otherwise, use both functions to set both the origin point and the destination.

    Gmaps::setOrigin($lat, $lng);
    Gmaps::setDestination($lat2, $lng2);

###Render
Now that the coordinates are set, run the render function to retrieve the html of the map.

    $data['map_html'] = Gmaps::render($map_num);

The $map_num parameter is dependent on how many maps you need displayed on the page.

* If you only need one map, it's simple
    * ``$data['map_html'] = Gmaps::render(1);``

* If you need more maps, do a **for loop** repeating ``Gmaps::setOrigin($lat, $lng);`` and ``Gmaps::setDestination($lat2, $lng2);`` for each new set of coordinates.
    * Then run ``$data[$i]['map_html'] = Gmaps::render($i + 1);`` where ``$i`` is the iterator starting at 0.

###View Blade
Now it's as simple as echoing the html for the map in the view blade.
``{{ $map_html }} ``

##Using the Javascript (optional)
The gmaps.js file has a function it uses to generate the map called ``gmapsInitialize(data);``. You can call this function in your app's js files if you need to re-render the map (it will call map resize for you). Calling this function again may be necessary if you hide or resize the map at all. The parameter ``data`` is the data stored in the **data attributes** on the gmaps div that gets generated. You can retrieve this most easily using jQuery. For example:

    button.on('click', function() {
            // Get the specific map to open
            var thisMap = $(this).find('.gmap');
            // Get the data from the map
            var data = thisMap.data();
            // Show the map
            thisMap.fadeIn(100);
            gmapsInitialize(data);
         });