<?php
//include('constants.php');

$mysqli = new mysqli('localhost', 'gamention', 'aa123456', 'spaceece');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
