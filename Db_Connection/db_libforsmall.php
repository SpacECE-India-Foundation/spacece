<?php

$servername = "database-spacece.cjnrqpvibfnn.ap-south-1.rds.amazonaws.com";
$username = "spaceuser";
$password = "Spaceuser12#";
$dbname = "libforsmall";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
