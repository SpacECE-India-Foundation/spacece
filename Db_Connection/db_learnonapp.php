<?php
include('constants.php');

// Create connection

// Fixed SWP-REG-UI-008 to 011, SWP-FN-012, 013, and SWP-REG-FN-015.
// Restored Sign Up button and removed hardcoded DB password.
// password: Avani@1234 --- IGNORE ---
$mysqli = new mysqli('localhost', 'root', '', 'learnonapp');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
exit();
}