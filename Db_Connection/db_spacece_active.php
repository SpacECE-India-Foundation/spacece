<?php
include('constants.php');

// Create connection
$mysqli1 = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACE_ACTIVE);

// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to Database: " . $mysqli->connect_error;
    exit();
}