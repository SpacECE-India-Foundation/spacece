<?php
define('DB_SERVER','localhost');
define('DB_USER','ostechnix');
define('DB_PASS' ,'Password123#@!');
define('DB_NAME', 'cits1');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>