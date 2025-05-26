<?PHP
error_reporting(0);
session_start();
if (isset($_SESSION['current_user_email'])) {
	$email = $_SESSION['current_user_email'];
	$user = $_SESSION['current_user_name'];
} else {
	header('location:../../spacece_auth/login.php');
	exit();
}
$main_logo = "../../img/logo/SpacECELogo.jpg";
$module_logo = "../../img/logo/ConsultUs.jpeg";
$module_name = "ConsultUs";
$sub_page = true;
include_once './header_local.php';
include_once '../../common/header_module.php';

?>


<?php


$roomname = $_GET['roomname'];
//session_start();


include("../../Db_Connection/db_consultus_app.php");

/*$sql= "SELECT * FROM `chat` WHERE `room_name`='$roomname'";
 $res = mysqli_query($conn,$sql);
 if($res)
 {
     if(mysqli_num_rows($res)==0){
        $message = "this room does not exits";
        echo "<script language='javascript'> alert('$message')</script>";
        echo "<script language='javascript'> ";
       echo "window.location='http://localhost/chatapp';";
        echo'</script>';
     }
     else{

     }

 }
 else{
     echo "error:". mysqli_error($conn);
 }*/
?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<?= isset($extra_styles) ? $extra_styles : null ?>
	<!-- <style>
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
	</style> -->
	<!-- BUG ID-0000067 -->
	<title><?= isset($module_name) ? $module_name : 'SpaceECE' ?></title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: Arial, sans-serif;
		}

		body {
			background-color: #f0f0f0;
		}

		.container {
			display: flex;
			justify-content: center;
			padding: 20px;
		}

		.chat-container {
			width: 100%;
			max-width: 800px;
			border-radius: 10px;
			overflow: hidden;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}

		.chat-header {
			background-color: #f0f0f0;
			padding: 15px;
			text-align: center;
			border-bottom: 1px solid #ddd;
		}

		.chat-header h2 {
			margin: 0;
			font-size: 1.2em;
		}

		.chat-messages {
			background-color: rgb(237, 238, 234);
			height: 500px;
			overflow-y: auto;
			padding: 15px;
		}

		.chat-input-container {
			display: flex;
			border-top: 1px solid #ddd;
			background-color: #fff;
			padding: 10px;
		}

		.chat-input {
			flex: 1;
			border: 1px solid #ddd;
			border-radius: 20px;
			padding: 10px 15px;
			outline: none;
			resize: none;
			height: 50px;
			margin-right: 10px;
		}

		.send-button {
			background-color: #f0f0f0;
			border: 1px solid #ddd;
			border-radius: 50%;
			width: 50px;
			height: 50px;
			cursor: pointer;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.send-icon {
			display: inline-block;
			font-size: 18px;
		}
	</style>
</head>

<body>
	<!-- <header>
		<?php $main_page = isset($main_page) ? ($main_page) :  NULL ?>

		<nav class="navbar">
			<div class="logo">
				<div class="org_logo">
					<a href=<?= $main_page ? "./index.php" : "../../index.php" ?>>
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
				<a href="../about.php"><i class="fas fa-address-card"></i><span>About</span></a>
			</div>
			<div class="user">
				<?php
				if (isset($_SESSION['current_user_id'])) {
				?>
					<div class="dropdown">
						<button class="dropbtn">
							<img class="user_avatar" src=<?= !isset($_SESSION['current_user_image']) ? 'https://www.w3schools.com/howto/img_avatar.png' : ($main_page ? './img/users/' . $_SESSION['current_user_image'] : '../../img/users/' . $_SESSION['current_user_image']) ?> alt="User" />
							<span style="cursor: pointer;">Hi, <?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : 'Guest' ?></span>
						</button>
						<div class="dropdown-content">
							<a href="<?= isset($main_page) ? "./spacece_auth/profile.php" : "../../spacece_auth/profile.php" ?>"><i class="fas fa-user"></i><span>Profile</span></a>
							<?= isset($extra_profile_links) ? $extra_profile_links : null ?>
							<a href=<?= isset($main_page) ? "./spacece_auth/logout.php" : "../../spacece_auth/logout.php" ?>><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
						</div>
					</div>
				<?php
				} else {
				?>
					<a href=<?= isset($main_page) ? "./spacece_auth/register.php" : "../../spacece_auth/register.php" ?>>
						<i class="fas fa-user-plus"></i><span>Register</span></a>
					<a href=<?= isset($main_page) ? "./spacece_auth/login.php" : "../../spacece_auth/login.php" ?>>
						<i class="fas fa-sign-in-alt"></i><span>Login</span></a>
				<?php
				}
				?>
			</div>
		</nav>
	</header> -->

	<div class="container mt-5 pt-5">
		<div class="chat-container">
			<div class="chat-header">
				<h2>Global Chat - <?php echo $roomname; ?></h2>
			</div>
			<div id="anyclass" class="chat-messages">
				<!-- Messages will be loaded here via AJAX -->
			</div>
			<div class="chat-input-container">
				<textarea class="chat-input" name="usermsg" id="usermsg" placeholder="Type a message..."></textarea>
				<button class="send-button" name="submit" id="submit">
					<span class="send-icon">➤</span>
				</button>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<?php
	include_once '../../common/footer_module.php';
	?>
	<script type="text/javascript">
		// new msg in 1s check
		// bug id=0000017
		setInterval(runFunction, 1000);

		function runFunction() {

			$.ajax({
				method: 'POST',
				data: {
					room: '<?php echo $roomname ?>'
				},
				url: 'htcont.php',
				success: function(data, status) {
					document.getElementById('anyclass').innerHTML = data;
					// Auto scroll to bottom for new messages
					var chatContainer = document.getElementById('anyclass');
					chatContainer.scrollTop = chatContainer.scrollHeight;
				}
			})
			// $.post("htcont.php",{room: '<?php //echo $roomname 
											?>'},
			// function(data,status)
			// {
			//     document.getElementsByClassName('anyclass')[0].innerHTML= data;

			// }
			// )
		}

		// submitting on enter:credit w3 school
		var input = document.getElementById("usermsg");
		input.addEventListener("keyup", function(event) {
			if (event.keyCode === 13) {
				event.preventDefault();
				document.getElementById("submit").click();
			}
		});
		$("#submit").click(function(e) {

			var clientmsg = $('#usermsg').val();
			if (clientmsg) {


				$.ajax({
					method: 'POST',
					data: {
						text: clientmsg,
						room: '<?php echo $roomname ?>',
						ip: '<?php echo $_SERVER['REMOTE_ADDR'] ?>'
					},
					url: 'postmsg.php',
					success: function(data, status) {
						$('#anyclass')[0].append(data);
						//  document.getElementsByClassName('anyclass')[0].innerHTML= data;
						const messages = document.getElementById('anyclass');
						const messagesid = document.getElementById('msg');
						messages.scrollTop = 60;
						//   var l = document.getElementsByClassName("anyclass").length;
						//   alert(l);

						// document.getElementsById("anyclass")[l-1].scrollIntoView();

					}
				})
			}
			//   var clientmsg =$('#usermsg').val();

			// $.post("postmsg.php", {text : clientmsg , room: '<?php echo $roomname ?>' , ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>' },
			// function(data,status){
			//     document.getElementsByClassName('anyclass')[0].innerHTML = data;
			// });
			$("#usermsg").val("");
			return false;
		});
		// $("#submit").click(function() {
		//   //document.getElementById('elementtoScrollToID').scrollTop = message.offsetHeight + message.offsetTop; 
		//     $([document.documentElement, document.body]).animate({
		//         scrollTop: $("#elementtoScrollToID").offset().top
		//     }, 200);
		//     //$("#elementtoScrollToID").scrollTop(textdiv.outerHeight());
		// });
	</script>
</body>

</html>