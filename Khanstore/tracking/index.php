<?php


require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();





$geoplugin->locate();
 $geoplugin->longitude;
 $geoplugin->city;
 $lat=$geoplugin->latitude;
 $lan= $geoplugin->longitude;
 $geoplugin->regionName;
// echo "Geolocation results for {$geoplugin->ip}: <br />\n".
// 	"City: {$geoplugin->city} <br />\n".
// 	"Region: {$geoplugin->region} <br />\n".
// 	"Region Code: {$geoplugin->regionCode} <br />\n".
// 	"Region Name: {$geoplugin->regionName} <br />\n".
// 	"DMA Code: {$geoplugin->dmaCode} <br />\n".
// 	"Country Name: {$geoplugin->longitude} <br />\n".
// 	"Country Code: {$geoplugin->countryCode} <br />\n".
// 	"In the EU?: {$geoplugin->inEU} <br />\n".
// 	"EU VAT Rate: {$geoplugin->euVATrate} <br />\n".
// 	"Latitude: {$geoplugin->latitude} <br />\n".
// 	"Longitude: {$geoplugin->longitude} <br />\n".
// 	"Radius of Accuracy (Miles): {$geoplugin->locationAccuracyRadius} <br />\n".
// 	"Timezone: {$geoplugin->timezone} <br />\n".
// 	"Currency Code: {$geoplugin->currencyCode} <br />\n".
// 	"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
// 	"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";


// if ( $geoplugin->currency != $geoplugin->currencyCode ) {
	
// 	echo "<p>At todays rate, US$100 will cost you " . $geoplugin->convert(100) ." </p>\n";
// }


// $nearby = $geoplugin->nearby();

// if ( isset($nearby[0]['geoplugin_place']) ) {

// 	echo "<pre><p>Some places you may wish to visit near " . $geoplugin->city . ": </p>\n";

// 	foreach ( $nearby as $key => $array ) {
		
// 		echo ($key + 1) .":<br />";
// 		echo "\t Place: " . $array['geoplugin_place'] . "<br />";
// 		echo "\t Region: " . $array['geoplugin_region'] . "<br />";
// 		echo "\t Latitude: " . $array['geoplugin_latitude'] . "<br />";
// 		echo "\t Longitude: " . $array['geoplugin_longitude'] . "<br />";
// 	}
// 	echo "</pre>\n";
// }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tracking</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  
	<style>
    
#map {
  height: 100%;
}

/* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.custom-map-control-button {
  background-color: #fff;
  border: 0;
  border-radius: 15px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  height: 40px;
  cursor: pointer;
}
.custom-map-control-button:hover {
  background: #ebebeb;
}
</style>
   
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-vXTWRt-7z9L1Q1KL6FFtMJCx-eYFIfg&callback=initMap&libraries=&v=weekly&channel=2"
      async
    ></script>
   
	<script>
	let map, infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat:<?php echo $lat ?>, lng: <?php  echo $lan ?> },
    zoom: 10,
  });
  infoWindow = new google.maps.InfoWindow();

  const locationButton = document.createElement("button");

  locationButton.textContent = "Pan to Current Location";
  locationButton.classList.add("custom-map-control-button");
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
  locationButton.addEventListener("click", () => {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        (position) => {
          const pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          infoWindow.setPosition(pos);
          infoWindow.setContent("Location found.");
          infoWindow.open(map);
          map.setCenter(pos);
        },
        () => {
          handleLocationError(true, infoWindow, map.getCenter());
        }
      );
    } else {
      // Browser doesn't support Geolocation
      handleLocationError(false, infoWindow, map.getCenter());
    }
  });
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  infoWindow.open(map);
}
		</script>
  </body>
</html>