<?php
define('DB_HOST_NAME', 'localhost');
define('DB_USER_NAME', 'root');
define('DB_USER_PASSWORD', '');
define('DB_USER_DATABASE', 'spaceece');
$conn = new mysqli(DB_HOST_NAME, DB_USER_NAME, DB_USER_PASSWORD, DB_USER_DATABASE);

if ($conn) {
} else {
    die("Connection failed: " . $conn->connect_error);
}