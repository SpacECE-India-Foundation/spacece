<?php
include_once('../db.php');
require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();

 $geoplugin->locate();
 $geoplugin->longitude;
 $geoplugin->city;
 $lat=$geoplugin->latitude;
 $lan= $geoplugin->longitude;
 $geoplugin->regionName;
 $user_id=$_SESSION['current_user_id'];
 $delivery_id=$_GET['id'];
    $tracking_id=$_GET['tracking_id'];
$sql="SELECT * from tracking Where user_id=$user_id,delivery_boy_id=$delivery_id and is_Active='1' ";
$res=mysqli_fetch_assoc($conn,$sql);
$lat1=$res['user_lat'];
$lat2=$res['user_lang'];
$lang1=$res['delivery_lat'];
$lang2=$res['delivery_lang'];



?>


<!DOCTYPE html>
<html>
  <head>
    <title> Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <!-- jsFiddle will insert css and js -->
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <p>Total Distance: <span id="total"></span></p>
        <div id="panel"></div>
      </div>
    </div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    <script>
        function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 6,
      center: {  lat:<?php echo $lat ?>, lng: <?php  echo $lan ?> }, // Australia.
    });
    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
      draggable: true,
      map,
      panel: document.getElementById("panel"),
    });
  
    directionsRenderer.addListener("directions_changed", () => {
      const directions = directionsRenderer.getDirections();
  
      if (directions) {
        computeTotalDistance(directions);
      }
    });
    displayRoute(
        {  lat:<?php echo $lat1 ?>, lng: <?php  echo $lan1 ?> },
        {  lat:<?php echo $lat2 ?>, lng: <?php  echo $lan2 ?> },
      directionsService,
      directionsRenderer
    );
  }
  
  function displayRoute(origin, destination, service, display) {
    service
      .route({
        origin: origin,
        destination: destination,
        waypoints: [
          
          
        ],
        travelMode: google.maps.TravelMode.DRIVING,
        avoidTolls: true,
      })
      .then((result) => {
        display.setDirections(result);
      })
      .catch((e) => {
        alert("Could not display directions due to: " + e);
      });
  }
  
  function computeTotalDistance(result) {
    let total = 0;
    const myroute = result.routes[0];
  
    if (!myroute) {
      return;
    }
  
    for (let i = 0; i < myroute.legs.length; i++) {
      total += myroute.legs[i].distance.value;
    }
  
    total = total / 1000;
    document.getElementById("total").innerHTML = total + " km";
  }

    </script>
  </body>
</html>