<?php

include '../Config/Functions.php';
$Fun_call = new Functions();


include '../connection.php';

$ids = $_GET['id'];


$removequery = "DELETE FROM `videos` WHERE `v_id` = {$ids} ";

$res = mysqli_query($conn, $removequery);

header("Location: home.php");
exit();


?>


