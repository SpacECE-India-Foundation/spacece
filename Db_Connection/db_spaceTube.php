<?php
$mysqli = new mysqli('localhost','ostechnix' , 'Password123#@!', 'gallery2');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  //  exit();
}
