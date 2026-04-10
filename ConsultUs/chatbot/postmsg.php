<?php
session_start();
include("../../Db_Connection/db_consultus_app.php");

$msg  = trim($_POST['text'] ?? '');
$room = $_POST['room'] ?? '';
$ip   = $_POST['ip'] ?? '';
$uname = isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : '';

if($uname === 'Bot') { exit(); }

$msg = mysqli_real_escape_string($conn, $msg);
$sql = "INSERT INTO `msg`(`msg`, `room`, `ip`, `rtime`, `u_name`) 
        VALUES ('$msg','$room','$ip',CURRENT_TIMESTAMP,'$uname')";
mysqli_query($conn, $sql);

$check = "SELECT replies FROM chatbot WHERE '$msg' LIKE CONCAT('%', queries, '%')";
$run   = mysqli_query($conn, $check);

if($run && mysqli_num_rows($run) > 0){
    $fetch     = mysqli_fetch_assoc($run);
    $bot_reply = mysqli_real_escape_string($conn, $fetch['replies']);
} else {
    $bot_reply = "Sorry I cannot understand you";
}

$bot_sql = "INSERT INTO `msg`(`msg`, `room`, `ip`, `rtime`, `u_name`) 
            VALUES ('$bot_reply','$room','127.0.0.1',CURRENT_TIMESTAMP,'Bot')";
mysqli_query($conn, $bot_sql);
?>