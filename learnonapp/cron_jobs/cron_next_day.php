<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "spaceece";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php

$sql = "UPDATE users SET days = days + 1";

if ($conn->query($sql)) {
    echo "Records updated successfully";
}

$conn->close();

die();

?>