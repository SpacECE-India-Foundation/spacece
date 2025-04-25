<?php
include('constants.php');

// Create connection
$mysqli = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_LEARNONAPP);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
