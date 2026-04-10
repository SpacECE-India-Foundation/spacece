<?php

include './header_local.php';
include '../../../common/header_module.php';

if (empty($_SESSION['current_user_email'])) {
	header('location:../../../spacece_auth/login.php');
	exit();
}
//ssion_start();
error_reporting(0);
//include('include/config.php');
//include('include/checklogin.php');
//check_login();

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Doctor | Dashboard</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
	<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
	<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<?= isset($extra_styles) ? $extra_styles : null ?>
	<style>
		body {
			margin: 0;
			padding: 0;
		}

		.navbar {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color: #FFA500;
			padding: 20px;
			font-size: large;
		}

		.navbar .logo {
			display: flex;
		}

		.navbar div a span {
			margin-left: 10px;
		}

		.navbar .logo div a {
			display: flex;
			align-items: center;
			gap: 5px;
		}

		.navbar .logo img {
			width: 75px;
			height: 75px;
			border-radius: 50%;
		}

		.navbar a {
			margin-right: 20px;
			text-decoration: none;
			color: #000;
		}

		.dropbtn {
			background-color: #FFA500;
			color: #000;
			padding: 16px;
			font-size: 16px;
			border: none;
		}

		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f1f1f1;
			min-width: 160px;
			right: 10px;
			box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropbtn:focus {
			outline: none;
		}

		.dropdown-content a:hover {
			background-color: #ddd;
		}

		.dropdown:hover .dropdown-content {
			display: block;
		}

		.user_avatar {
			width: 50px;
			height: 50px;
			border-radius: 50%;
			margin-right: 10px;
		}

		.banner {
			width: 100%;
			height: 50vh;
			margin: 20px 0 50px;
		}

		.banner img {
			height: 100%;
			width: 100%;
		}

		body {
			color: #536482;
			background-color: white;
		}

		.center {
			text-align: center;
		}

		.justify {
			text-align: justify;
		}

		.about-page {
			display: flex;
			flex-direction: column;
		}

		.about-page .about-moto {
			display: flex;
			min-height: 320px;
			background-color: #f6f6f6;
			padding: 40px 80px;
			align-items: center;
			justify-content: center;
		}

		.about-page .about-desc {
			display: flex;
			flex-direction: column;
			padding: 40px 80px;
		}

		.about-page .about-desc h3 span {
			border-bottom: 2px solid #536482;
		}

		.about-page .about-desc p {
			margin-top: 20px;
			font-size: 20px;
			color: #707070;
			font-weight: 400;
			line-height: 1.5;
		}

		#js-pro-pic {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: 10px;
		}

		#js-pro-pic img {
			height: 100px;
			width: 100px;
			object-fit: cover;
			border-radius: 50%;
		}

		.fileToUpload {
			opacity: 0;
			width: 17%;
			height: 4%;
			position: absolute;
			z-index: 999;
			cursor: pointer;
		}

		@media (max-width: 640px) {
			.fileToUpload {
				width: 41%;
				height: 3%;
			}
		}

		.file-input label {
			margin: 0 auto;
			display: block;
			width: 200px;
			height: 50px;
			border-radius: 25px;
			background-color: #FFA500;
			box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
			display: flex;
			align-items: center;
			justify-content: center;
			color: #fff;
			font-weight: bold;
			cursor: pointer;
			transition: transform .2s ease-out;
		}

		input:hover+label,
		input:focus+label {
			transform: scale(1.02);
		}

		input:focus+label {
			outline: 1px solid #000;
			outline: -webkit-focus-ring-color auto 2px;
		}

		.file-name {
			font-size: 1.2rem;
			color: #555;
			display: flex;
			justify-content: center;
			margin-top: 10px;
		}

		.fileToUpload {
			cursor: pointer;
		}
	</style>
	<!-- BUG ID-0000067 -->
	<title><?= isset($module_name) ? $module_name : 'SpaceECE' ?></title>


	<style>
		.navbar {
			height: 14%;
		}
		.side-nav {
		margin-top: 5%;
	}
	</style>
</head>

<body style="background-image:url('b1.jpg'); background-repeat: no-repeat; background-size: cover; background-filter: blur(8px); background-position: center;
  " class="hold-transition login-page">


<header>
		<?php $main_page = isset($main_page) ? ($main_page) :  NULL ?>

		<nav class="navbar">
			<div class="logo">
				<div class="org_logo">
					<a href=<?= $main_page ? "./index.php" : "../../../index.php" ?>>
						<img src="<?= isset($main_logo) ? $main_logo : '#' ?>" alt="Spacece">
						<span>SpaceECE</span>
					</a>
				</div>
				<?php
				if (isset($module_name)) {
				?>
					<div class="module_logo">
						<a href="./index.php">
							<img src="<?= isset($module_logo) ? $module_logo : 'Spacece' ?>" alt="Module">
							<span><?= isset($module_name) ? $module_name : 'Spacece' ?><span>
						</a>
					</div>
				<?php
				}
				?>
			</div>
			<div class="main_nav">
				<a href="./index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a>
				<?= isset($extra_main_nav_links) ? $extra_main_nav_links : null ?>
				<a href="../../about.php"><i class="fas fa-address-card"></i><span>About</span></a>
			</div>
			<div class="user">
				<?php
				if (isset($_SESSION['current_user_id'])) {
				?>
					<div class="dropdown">
						<button class="dropbtn">
							<img class="user_avatar" src=<?= !isset($_SESSION['current_user_image']) ? 'https://www.w3schools.com/howto/img_avatar.png' : ($main_page ? './img/users/' . $_SESSION['current_user_image'] : '../../../img/users/' . $_SESSION['current_user_image']) ?> alt="User" />
							<span style="cursor: pointer;">Hi, <?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : 'Guest' ?></span>
						</button>
						<div class="dropdown-content">
							<a href="<?= isset($main_page) ? "./spacece_auth/profile.php" : "../../../spacece_auth/profile.php" ?>"><i class="fas fa-user"></i><span>Profile</span></a>
							<?= isset($extra_profile_links) ? $extra_profile_links : null ?>
							<a href=<?= isset($main_page) ? "./spacece_auth/logout.php" : "../../../spacece_auth/logout.php" ?>><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
						</div>
					</div>
				<?php
				} else {
				?>
					<a href=<?= isset($main_page) ? "./spacece_auth/register.php" : "../../../spacece_auth/register.php" ?>>
						<i class="fas fa-user-plus"></i><span>Register</span></a>
					<a href=<?= isset($main_page) ? "./spacece_auth/login.php" : "../../../spacece_auth/login.php" ?>>
						<i class="fas fa-sign-in-alt"></i><span>Login</span></a>
				<?php
				}
				?>
			</div>
		</nav>
	</header>

	<?php // include('include/head.php');
	?>

	<!-- end: TOP NAVBAR -->

	<!-- start: PAGE TITLE -->
	<section id="page-title">
		<div class="row">
			<div class="col-sm-8">
				<h1 style="color: red;font-weight:bold;padding-left: 550px;margin-top: 50px;" class="mainTitle">Doctor | Dashboard</h1>
			</div>

		</div>
	</section>
	<!-- Breadcrumbs-->
	<div class="mt-3" style="margin-top:5%;">
		<?php include('include/sidenav.html'); ?>
	</div>
	<!-- end: PAGE TITLE -->
	<!-- start: BASIC EXAMPLE -->
	<div style="padding-left: 350px;" class="container-fluid container-fullw bg-skyblue">
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-orange no-radius text-center">
					<div class="panel-body">
						<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
						<h2 style="color: white" class="StepTitle">My Profile</h2>

						<p class="links cl-effect-1">
							<a style="color: white" href="edit-profile.php">
								Update Profile
							</a>
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="panel panel-yellow no-radius text-center">
					<div class="panel-body">
						<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
						<h2 style="color: white" class="StepTitle">My Appointments</h2>

						<p class="cl-effect-1">
							<a style="color: white" href="appointment-history.php">
								View Appointment History
							</a>
						</p>
					</div>
				</div>
			</div>

		</div>
	</div>






	<!-- end: SELECT BOXES -->

	</div>
	</div>
	</div>
	<!-- start: FOOTER -->
	<?php include('../../../common/footer_module.php'); ?>
	<!-- end: FOOTER -->

	</div>
	<!-- start: MAIN JAVASCRIPTS -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<!-- end: MAIN JAVASCRIPTS -->
	<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
	<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="vendor/autosize/autosize.min.js"></script>
	<script src="vendor/selectFx/classie.js"></script>
	<script src="vendor/selectFx/selectFx.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
	<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
	<!-- start: CLIP-TWO JAVASCRIPTS -->
	<script src="assets/js/main.js"></script>
	<!-- start: JavaScript Event Handlers for this page -->
	<script src="assets/js/form-elements.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			FormElements.init();
		});
	</script>
	<!-- end: JavaScript Event Handlers for this page -->
	<!-- end: CLIP-TWO JAVASCRIPTS -->
</body>

</html>
