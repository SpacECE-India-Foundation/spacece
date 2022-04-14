<?php


$mysqli1 = new mysqli('database-spacece.cjnrqpvibfnn.ap-south-1.rds.amazonaws.com', 'spaceuser', 'Spaceuser12#', 'space_active');
 //$mysqli1 = new mysqli('localhost', 'root', '', 'space_active');
// Check connection
if ($mysqli1->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
