<?php

  //Include Google Configuration File
  include('gconfig.php');

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   $google_login_btn = '<a href="'.$google_client->createAuthUrl().'"><img src="https://www.tutsmake.com/wp-content/uploads/2019/12/google-login-image.png" /></a>';
   echo $google_login_btn ;
  } else {

    header("Location: dashboard.php");
  }
?>
