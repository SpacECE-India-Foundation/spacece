<?php
//session_start();
include './header_local.php';
include '../../../common/header_module.php';
if (empty($_SESSION['current_user_email'])) {
	header('location:../../../spacece_auth/login.php');
	exit();
}
error_reporting(0);
include("include/config.php");
//Checking Details for reset password
if (isset($_POST['submit'])) {
	$name = $_POST['fullname'];
	$email = $_POST['email'];
	$query = mysqli_query($con, "select id from  doctors where docName='$name' and docEmail='$email'");
	$row = mysqli_num_rows($query);
	if ($row > 0) {

		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;
		header('location:reset-password.php');
	} else {
		echo "<script>alert('Invalid details. Please try with valid details');</script>";
		echo "<script>window.location.href ='forgot-password.php'</script>";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Doctor | Password Recovery</title>

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
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
		body {
			background-color: #f7f7f7;
		}

		.main-login {
			margin-top: 50px;
		}

		.logo h2 {
			font-size: 28px;
			text-align: center;
			color: #333;
		}

		.box-login {
			padding: 30px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
		}

		.form-login legend {
			text-align: center;
			font-size: 24px;
			margin-bottom: 20px;
		}

		.form-group {
			position: relative;
		}

		.input-icon {
			display: flex;
			align-items: center;
		}

		.input-icon input {
			padding-left: 35px;
		}

		.input-icon i {
			position: absolute;
			left: 10px;
			color: #999;
			font-size: 14px;
			align-items: center;
			text-align: center;
			justify-content: center;
			margin-left: -4px;
			margin-top: -1px;
		}

		.form-actions {
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.form-actions button {
			background-color: #5bc0de;
			border: none;
		}

		.new-account {
			text-align: center;
			margin-top: 20px;
		}

		.new-account a {
			color: #5bc0de;
		}
	</style>
	<style>
		.navbar {
			height: 14%;
		}

		.side-nav {
			margin-top: 5%;
		}
		h2{
			margin-top: 50px;
		}
	</style>
</head>

<body style="background-color: skyblue" class="login">
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
	<div class="container">
		<div class="row">
			<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="logo margin-top-30">
					<a href="../home.php">
						<h2>CITS | Doctor Password Recovery</h2>
					</a>
				</div>
				<div class="box-login">
					<form class="form-login" method="post">
						<fieldset>
							<legend>Doctor User Password Recovery</legend>
							<p>Please enter your Email and Full Name to recover your password.</p>
							<div class="form-group form-actions">
								<span class="input-icon">
									<input type="text" class="form-control" name="fullname" placeholder="Registered Full Name">
									<i class="fa fa-user"></i>
								</span>
							</div>
							<div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Registered Email">
									<i class="fa fa-envelope"></i>
								</span>
							</div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary pull-left" name="submit">Reset <i class="fa fa-arrow-circle-right"></i></button>
							</div>
							<div class="new-account">
								Already have an account?
								<a href="./index.php">Log-in</a>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include '../../../common/footer_module.php'; ?>
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

	<script src="assets/js/main.js"></script>

	<script src="assets/js/login.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>
