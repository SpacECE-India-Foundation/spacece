<?php


$mysqli1 = new mysqli('localhost', 'gamention', 'aa123456', 'space_active');

// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
