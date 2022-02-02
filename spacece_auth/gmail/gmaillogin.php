 

<?php


 //if(isset($_POST['gmail'])){
  include 'config.php';
  
  
    if(!isset($_SESSION['access_token'])) {
      //Create a URL to obtain user authorization
      $google_login_btn = '<a class="btn btn-sm btn-social" href="'.$google_client->createAuthUrl().'"><img src="https://www.tutsmake.com/wp-content/uploads/2019/12/google-login-image.png" /></a>';
      
     }else{
       header('Location:../index.php');
     }
   
  
   // $sql="Insert into social_login (email,name) VALUES('".$data['given_name']."','" .$data['email']."')";
    
  //} 
  ?>
  <?php
    echo $google_login_btn;
   ?>