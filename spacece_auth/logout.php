<?php
session_start();
if (isset($_SESSION['current_user_id']))
    unset($_SESSION['current_user_id']);
if (isset($_SESSION['current_user_email']))
    unset($_SESSION['current_user_email']);
if (isset($_SESSION['current_user_name']))
    unset($_SESSION['current_user_name']);
if (isset($_SESSION['current_user_mob']))
    unset($_SESSION['current_user_mob']);
if (isset($_SESSION['current_user_image']))
    unset($_SESSION['current_user_image']);
if (isset($_SESSION['current_user_type']))
    unset($_SESSION['current_user_type']);

//For consultant 

if (isset($_SESSION["consultant_category"]))
    unset($_SESSION["consultant_category"]);
if (isset($_SESSION["consultant_office"]))
    unset($_SESSION["consultant_office"]);
if (isset($_SESSION["consultant_from_time"]))
    unset($_SESSION["consultant_from_time"]);
if (isset($_SESSION["consultant_to_time"]))
    unset($_SESSION["consultant_to_time"]);
if (isset($_SESSION["consultant_language"]))
    unset($_SESSION["consultant_language"]);
if (isset($_SESSION["consultant_fee"]))
    unset($_SESSION["consultant_fee"]);
if (isset($_SESSION["consultant_available_from"]))
    unset($_SESSION["consultant_available_from"]);
if (isset($_SESSION["consultant_available_to"]))
    unset($_SESSION["consultant_available_to"]);
if (isset($_SESSION["consultant_qualification"]))
    unset($_SESSION["consultant_qualification"]);


// $google_client->revokeToken();
$redirect_url = $_SERVER['HTTP_REFERER'];
session_destroy();
// header('Location:./index.php');
header("Location: " . $redirect_url);
exit();
