<?php
include('constants.php');
define('DB_USER_DATABASE', 'spaceece');
$conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);

if ($conn) {
} else {
    die("Connection failed: " . $conn->connect_error);
}
