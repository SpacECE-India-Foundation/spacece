<?php

include('constants.php');

//session_start();
define("SITEURL", '');

// Create connection
$conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_CONSULTANT_APP);
$conn = new mysqli('localhost', 'root', '', 'consultant_app');

// Check connection
if ($conn->connect_error) {
  die("Failed to connect to Database: " . $conn->connect_error);
}
return $conn;