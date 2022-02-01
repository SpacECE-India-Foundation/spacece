 
<?php

//index.php
//Include Configuration File
// include './config.php';
// include './db.php';
// $login_button = '';

// //This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
// if(isset($_GET["code"]))
// {
//  //It will Attempt to exchange a code for an valid authentication token.
//  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//  //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
//  if(!isset($token['error']))
//  {
//   //Set the access token used for requests
//   $google_client->setAccessToken($token['access_token']);

//   //Store "access_token" value in $_SESSION variable for future use.
//   $_SESSION['access_token'] = $token['access_token'];

//   //Create Object of Google Service OAuth 2 class
//   $google_service = new Google_Service_Oauth2($google_client);

//   //Get user profile data from google
//   $data = $google_service->userinfo->get();
  
 // 
//   if(!empty($data['given_name']))
//   {
//    $_SESSION['user_first_name'] = $data['given_name'];
//   }

//   if(!empty($data['family_name']))
//   {
//    $_SESSION['user_last_name'] = $data['family_name'];
//   }

//   if(!empty($data['email']))
//   {
//    $_SESSION['user_email_address'] = $data['email'];
//   }

//   if(!empty($data['gender']))
//   {
//    $_SESSION['user_gender'] = $data['gender'];
//   }

//   if(!empty($data['picture']))
//   {
//    $_SESSION['user_image'] = $data['picture'];
//   }
 //}
// }
// else{
//  // echo '<a id="google-button" class="btn btn-block btn-social btn-google"><i class="fa fa-google"></i> Sign in with Google</a>';
// }// //This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
// if(!isset($_SESSION['access_token']))
// {
//   $login_button=$google_client->createAuthUrl();
//  //Create a URL to obtain user authorization
// echo '<a href="'.$google_client->createAuthUrl().'" id="google-button" class="btn btn-block btn-social btn-google"><i class="fa fa-google"></i> Sign in with Google</a>';

// //echo '<div align="center">'.$login_button . '</div>';
// }


?>

<?php
//include './config.php';
echo "Inside";
 if(isset($_POST['gmail'])){
   echo "Inside";
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

//     //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
//     if(!isset($token['error']))
//     {
//      //Set the access token used for requests
//      $google_client->setAccessToken($token['access_token']);
   
//      //Store "access_token" value in $_SESSION variable for future use.
//      $_SESSION['access_token'] = $token['access_token'];
   
//      //Create Object of Google Service OAuth 2 class
//      $google_service = new Google_Service_Oauth2($google_client);
   
//      //Get user profile data from google
//      $data = $google_service->userinfo->get();

//     $google_client->createAuthUrl();
//     echo "hello";
    //Below you can find Get profile data and store into $_SESSION variable
   // $sql="Insert into social_login (email,name) VALUES('".$data['given_name']."','" .$data['email']."')";
    //}
  } 