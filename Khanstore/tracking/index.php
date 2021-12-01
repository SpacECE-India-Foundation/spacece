<?php


require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();





$geoplugin->locate();
 $geoplugin->longitude;
 $geoplugin->city;
 $geoplugin->latitude;
 $geoplugin->longitude;
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
    <title>Simple Map</title>
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
</style>
   
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly"
      async
    ></script>
	<script>
		let map;

function initMap() {
  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 8,
  });
}
		</script>
  </body>
</html>