<?php
include_once('includes/config.php');
include_once('includes/header.php');

session_start();
session_destroy();
 $url = BASE_URL . 'login.php'; 
header("Location:$url");
exit();