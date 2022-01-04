<?php

$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/LearnOnApp.jpeg";
$module_name = "Learn On App";
$extra_styles = '
<link href="img/Favicon.ico" rel="shortcut icon" />
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
';
$extra_scripts = "<script src='./assets/js/main.js'></script>";
$banner_img = "../img/banner/LearnOnApp.png";

if (isset($_SESSION['current_user_id'])) {
	$extra_main_nav_links = "
    <a href='./my_courses.php'><i class='fas fa-book-open'></i><span>My Courses</span></a>
";
}
