

<?php
$DBHOST = '3.109.14.4';
$DBUSER = 'ostechnix';
$DBPASS = 'Password123#@!';
$DBNAME = 'gallery2';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);


if ($conn) {
} else {
    die("No Connection!");
}


?>