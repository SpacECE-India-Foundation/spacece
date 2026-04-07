<?php

  //Include Google Configuration File
  include('gconfig.php');
  $google_service = new Google_Service_Oauth2($google_client);

  if(!isset($_SESSION['access_token'])) {
   //Create a URL to obtain user authorization
   $google_login_btn = '<a class="btn btn-block btn-social btn-google" href="'.$google_client->createAuthUrl().'"><i class="fa fa-google"></i>Sign in with Gmail</a>';
   echo $google_login_btn ;
  } else {
    $data = $google_service->userinfo->get();
    $email= $data['email'];
    $check = "SELECT * FROM users WHERE u_email = '$email'";

    $run = mysqli_query($conn, $check);
   
     
    if (mysqli_num_rows($run) > 0) {
        echo "Exist";
   //     //echo json_encode(array('status' => 'error', "message" => "Email already exists!"));
   //     //die(); 
   // } else {
   //     if ($type == 'consultant') {
   //         $c_categories = $_POST['c_categories'];
   //         $c_office = $_POST['c_office'];
   //         $c_from_time = $_POST['c_from_time'];
   //         $c_to_time = $_POST['c_to_time'];
   //         $c_language = $_POST['c_language'];
   //         $c_fee = $_POST['c_fee'];
   //         // $c_available_from = $_POST['c_available_from'];
   //         // $c_available_to = $_POST['c_available_to'];
   //         $c_available_days=$_POST['selectedItem'];
   //         $c_qualification = $_POST['c_qualification'];
   //         $redirectUrl = '../index.php';
   //         $sql = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image, u_type) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image', '$type')";
   
   //         $result = mysqli_query($conn, $sql);
   
   //         $last_id = mysqli_insert_id($conn);
   
   //         $query = "INSERT INTO consultant (u_id, c_category, c_office, c_from_time, c_to_time, c_language, c_fee, c_available_from,c_aval_days) 
   //       VALUES ($last_id, $c_categories, '$c_office', '$c_from_time', '$c_to_time', '$c_language', '$c_fee', '$c_qualification','$c_available_days')";
   //     } else if ($type == 'customer') {
   //         $query = "INSERT INTO users (u_name, u_email, u_password, u_mob, u_image) VALUES ('$name', '$email', '$hashed_password', '$phone', '$image')";
   //         $redirectUrl = '../index.php';
   //     } else {
   //         echo json_encode(array('status' => 'error', 'message' => "Invalid user type!"));
   //         die();
   //     }
   
   }
   
    header("Location: dashboard.php");
  }
?>
