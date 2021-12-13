<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

$servername = "localhost";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "cms_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php


echo json_encode(['success' => false, 'message' => 'Something went wrong']);
die();

?>