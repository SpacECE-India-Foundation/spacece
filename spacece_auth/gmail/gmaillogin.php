 

<?php


 //if(isset($_POST['gmail'])){
  include './config.php';
  
  
    if(!isset($_SESSION['access_token'])) {
      //Create a URL to obtain user authorization
      $google_login_btn = '<a href="'.$google_client->createAuthUrl().'"><img src="https://www.tutsmake.com/wp-content/uploads/2019/12/google-login-image.png" /></a>';
      
     }else{
       header('Location:../index.php');
     }
   
  
   // $sql="Insert into social_login (email,name) VALUES('".$data['given_name']."','" .$data['email']."')";
    
  //} 
  ?>
  <?php
    echo '<div align="center">'.$google_login_btn . '</div>';
   ?>