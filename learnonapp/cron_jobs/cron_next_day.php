<?php
session_start();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

include './Db_Connection/db_spacece.php';
?>
<?php

$sql = "UPDATE users SET days = days + 1";

if ($conn->query($sql)) {
    echo "Records updated successfully";
}

$conn->close();

die();

?>