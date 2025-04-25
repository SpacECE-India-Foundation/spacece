<?php

include_once('../../Db_Connection/db_libforsmall.php');
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
$sql="SELECT * from tracking Where user_id=$user_id and is_Active='1' ";
$res=mysqli_fetch_assoc($mysqli,$sql);

?>


<!DOCTYPE html>
<html>
  <head>
    <title> Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <p>Total Distance: <span id="total"></span></p>
        <div id="panel"></div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly&channel=2"
      async
    ></script>
    <script>
          $(document).ready(function() {
      
        setInterval('refreshPage()',(2000*15));
    });

    function refreshPage() {
        var user=<?php echo $_SESSION['current_user_email']?>;
        var track_id=<?php echo $tracking_id  ?>;
       var lat=<?php echo $lat  ?>;
       var lang=<?php echo $lan  ?>;
        $.ajax({
            'method':'post',
            'data':{
                user:user,
                track_id:track_id,
                lat:lat,
                lang:lang
            },'url':'get_data.php?add',
            success:function(data){
var data1=JSON.parse(data);
                lat1=data1.delivery_lat;
                lang1=data1.delivery_lang;

  
}
        });

        
    }
  
         </script>
    <script>
       $(document).ready(function() {
        // Call refresh page function after 5000 milliseconds (or 5 seconds).
        setInterval('refreshPage()',(2000*15));
    });
   
        // var lat1=null;
       // var lang1=null;

       // var user=<?php  // $_SESSION['usr_email'] ?>;
        //var track_id=<?php  //echo $_GET['track_id'] ?>;
        
   
        function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 6,
      center: {  lat:<?php  echo $lat ?>, lng: <?php  echo $lan ?> },
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
function refreshPage() {
        var user=<?php echo $_SESSION['current_user_email']?>;
        var track_id=<?php echo $tracking_id  ?>;
       
        $.ajax({
            'method':'post',
            'data':{
                user:user,
                track_id:track_id
            },'url':'get_data.php?get',
            success:function(data){
var data1=JSON.parse(data);
                lat1=data1.delivery_lat;
                lang1=data1.delivery_lang;

    displayRoute(
        {  lat:<?php echo $lat1 ?>, lng: <?php  echo $lan1 ?> },
        {  lat:lat1, lng: lang1 },
      directionsService,
      directionsRenderer
    );
}
        });

        
    }
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


     

