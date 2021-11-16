<?php


$mysqli1 = new mysqli('3.109.14.4', 'ostechnix', 'Password123#@!', 'space_active');

// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
