<?php
session_start();

$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/LearnOnApp.jpeg";
$module_name = "Learn On App";
$extra_styles = '
<link href="img/Favicon.ico" rel="shortcut icon" />
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
';
$extra_scripts = "
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
<script src='./assets/js/main.js'></script>
";
$banner_img = "../img/banner/LearnOnApp.png";

if (isset($_SESSION['current_user_id'])) {
	$extra_main_nav_links = "
    <a href='./my_courses.php'><i class='fas fa-book-open'></i><span>My Courses</span></a>
";
}
