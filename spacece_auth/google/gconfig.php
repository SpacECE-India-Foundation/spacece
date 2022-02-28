<?php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('729562997354-kvfcqnk8ldgdms3nsa42h7sprp2b1s1n.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://spacefoundation.in/test/SpacECE-PHP/index.php');
$google_client->addScope('email');

$google_client->addScope('profile');
// $check = "SELECT * FROM users WHERE u_email = '$email'";

// $run = mysqli_query($conn, $check);

// if (mysqli_num_rows($run) > 0) {
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

// }

//start session on web page
if(empty($_SESSION)){
    session_start();
}

?>