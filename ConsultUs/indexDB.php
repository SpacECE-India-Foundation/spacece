<?php
//session_start();
define("SITEURL", '');
$servername = "3.109.14.4";
$username = "root";
$password = "";
// $servername = "3.109.14.4";
// $username = "ostechnix";
// $password = "Password123#@!";
$dbname = "consultant_app";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
