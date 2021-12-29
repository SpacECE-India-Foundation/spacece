<?php

$DBHOST = '3.109.14.4';
$DBUSER = 'ostechnix';
$DBPASS = 'Password123#@!';
$DBNAME = 'spaceece';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

if ($conn) {
    echo "Connected successfully";
} else {
    die("No Connection!");
}
