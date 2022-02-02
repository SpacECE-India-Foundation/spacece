<?php

  //Include Google Configuration File
  include('gconfig.php');

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   $google_login_btn = '<a class="btn btn-block btn-social btn-google" href="'.$google_client->createAuthUrl().'"><i class="fa fa-google"></i>Sign in with Facebook</a>';
   echo $google_login_btn ;
  } else {

    header("Location: dashboard.php");
  }
?>
