<?php
//include('constants.php');

$mysqli = new mysqli('3.109.14.4', 'ostechnix', 'Password123#@!', 'spaceece');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
