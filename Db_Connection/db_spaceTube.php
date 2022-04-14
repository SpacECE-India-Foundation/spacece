<?php

include('constants.php');

// Create connection
$mysqli = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACTUBE);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to Database: " . $mysqli->connect_error;
  //  exit();
}
