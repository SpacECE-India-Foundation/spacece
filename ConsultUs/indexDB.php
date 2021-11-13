<?php
session_start();
define("SITEURL", 'http://localhost/spacece/ConsultUs/');
$servername = "localhost";
$username = "gamention";
$password = "localhost";
$dbname = "consultant_app";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
