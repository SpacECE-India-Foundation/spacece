<?php
include('constants.php');

// Create connection
$conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACECE);
//$conn = new mysqli('localhost', 'root', '', 'spacece');


if ($conn) {
} else {
    die("Failed to connect to Database: " . $conn->connect_error);
}
