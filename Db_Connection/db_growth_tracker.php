<?php

include('constants.php');

// Create connection
$conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_GROWTH_TRACKER);

// Check connection
if ($conn->connect_errno) {
    echo "Failed to connect to Database: " . $conn->connect_error;
  //  exit();
}
