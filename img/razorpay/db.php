<?php
  // starting session
  include('../../Db_Connection/constants.php');
  session_start();
  //site url
   define("SITEURL",'http://localhost/razorpay/');

    // creating connection
    $conn = mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME_EMP2);

    if(!$conn){
        die("sorry we failed to connect:".mysqli_connect_error());
    }
 ?>


