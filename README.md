#Gmaps
The Google Maps Laravel package built for Insite. Supports placing multiple maps per page with an indefinite number of icons per map. Also supports custom images and infoboxes for map markers.

###TL:DR How it works
Calling the Facade functions **addPoint()** and **addManyPoints()** create an array of marker data that gets passed to the **gmaps.blade.php** view. From there it creates an empty div with data attributes containing the config data and the marker data. This div gets returned as a string of html when you run **render()**. You can then pass it to your view and echo the variable wherever you want the map to display. The javascript then runs on page load, finds all elements with class **.gmap**, reads the data attributes, and generates the map or maps based on those attributes. This was necessary to pass data from PHP to javascript without injecting javascript into the body of the DOM. Including a script tag to pull in google maps is not necessary as this package will do that for you.

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
                "url": "https://github.com/SpartanNash/insite-gmaps"
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
* **'zoom' -** The zoom level for when it just displays one marker.
* **'markers' -** Array of custom markers and the associated information necessary to display the markers such as width, height, and image url. (See config file comments for example on how to set these)

##How to Use
###Import Namespace
Place ``use Gmaps;`` at the top of your controller (or wherever you are using the class.

###Set Points
There are two functions you can use to set points:

**addPoint()**

    Gmaps::addPoint($lat, $long, $marker_name, $marker_content);

Adds one point at a time. Calling this function multiple times (such as in a for loop) is less error prone.

* **$lat -** Latitude of the marker
* **$lng -** Longitude of the marker
* **$marker_name -** The name of the marker. This is necessary if you've created custom markers in the config file. This ties the custom marker info (such as size and img url) to the lat/lng of this particular marker.
* **$marker_content -** The infobox content that gets displayed when you click on the marker. This is a string of html.
    
**addManyPoints()**

    Gmaps::addManyPoints($array);
Adds many or all of the points in one function call. Required array structure below:

    $array = [
        'lat' => $lat, 
        'lng' => $lng, 
        'marker_name' => $marker_name, 
        'info_content' => $info
    ],
        // Repeat

###Render
Now that the coordinates are set, run the render function to retrieve the html of the map.

    $data['map_html'] = Gmaps::render($map_num);

The $map_num parameter is dependent on how many maps you need displayed on the page.

* If you only need one map, it's simple
``$data['map_html'] = Gmaps::render();``

* If you need more maps and you're not dealing with static data, you can do a **for loop** and run ``$data[$i]['map_html'] = Gmaps::render($i + 1);`` where ``$i`` is the iterator starting at 0.

###View Blade
Now it's as simple as echoing the html for the map in the view blade.
``{{ $map_html }} ``

##Using the Javascript (optional)
The gmaps.js file has a function it uses to generate the map called ``gmapsInitialize(gmapElement);``. You can call this function in your app's js files if you need to re-render the map (it will call map resize for you). Calling this function again will be necessary if you hide or resize the map at all. Otherwise you just get a grey box instead of a map. The parameter ``gmapElement`` is the html element that gets autogenerated by Gmaps::render() and contains the gmap **data attributes**. Example usage of a gmap that's contained inside an accordion element:

    accordion.on('accordion.open', function() {
            // Get the specific map to open
            var thisMap = $(this).find('.gmap');
            if(thisMap.length > 0) {
               // Show the map
               thisMap.fadeIn(100);
               gmapsInitialize(thisMap);
            }
         });