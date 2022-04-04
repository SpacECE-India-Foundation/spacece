<?php


$mysqli1 = new mysqli('localhost', 'ostechnix', 'Password123#@!', 'space_active');
 //$mysqli1 = new mysqli('localhost', 'root', '', 'space_active');
// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
