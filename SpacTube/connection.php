<?php

$DBHOST = 'localhost';
$DBUSER = 'root';
$DBPASS = '';
$DBNAME = 'gallery';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);


if ($conn) {
} else {
    die("No Connection!");
}
