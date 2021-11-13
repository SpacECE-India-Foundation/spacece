<?php


$mysqli1 = new mysqli('localhost', 'ostechnix', 'Password123#@!', 'user');

// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

