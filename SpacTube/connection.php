<?php

$DBHOST = 'localhost';
$DBUSER = 'gamention';
$DBPASS = 'aa123456';
$DBNAME = 'gallery2';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);


if ($conn) {
} else {
    die("No Connection!");
}
