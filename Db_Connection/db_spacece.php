<?php
include('constants.php');

// Create connection

// Fixed SWP-REG-UI-008 to 011, SWP-FN-012, 013, and SWP-REG-FN-015.
// Restored Sign Up button and removed hardcoded DB password.
// password: Avani@1234 --- IGNORE ---
// $conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_NAME_SPACECE);
// $conn = new mysqli('localhost', 'root', '', 'spacece');
$conn = new mysqli("localhost", "root", "", "spacece");


if ($conn) {
} else {
    die("Failed to connect to Database: " . $conn->connect_error);
}
