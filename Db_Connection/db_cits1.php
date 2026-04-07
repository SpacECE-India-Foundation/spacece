<?php
include('constants.php');

// Fixed SWP-REG-UI-008 to 011, SWP-FN-012, 013, and SWP-REG-FN-015.
// Restored Sign Up button and removed hardcoded DB password.
// password: Avani@1234 --- IGNORE ---


// Create connection
$conn = new mysqli('localhost', 'root', '', 'cits');

// Check connection
if ($conn->connect_error) {
   echo("Failed to connect to Database: " . $conn->connect_error);
}

