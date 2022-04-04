<?php

$servername = "localhost";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "khanstore";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
