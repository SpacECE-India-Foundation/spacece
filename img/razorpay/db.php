<?php
  // starting session
  session_start();
  //site url
   define("SITEURL",'http://localhost/razorpay/');

   define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','emp2');
    // creating connection
    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if(!$conn){
        die("sorry we failed to connect:".mysqli_connect_error());
    }
 ?>
