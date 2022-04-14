<?php
$mysqli = new mysqli('database-spacece.cjnrqpvibfnn.ap-south-1.rds.amazonaws.com', 'spaceuser' , 'Spaceuser12#', 'spactube');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  //  exit();
}
