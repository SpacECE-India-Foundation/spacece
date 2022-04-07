<?php
include '../Db_Connection/db_spacece.php';
$username = $name  = $email = $password = $cpassword = $phone = "" ; 

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$usernameErr = $nameErr = $emailErr = $passwordErr = $cpasswordErr = $phoneErr = "";
$b=true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["username"])) {
        $usernameErr = "*Username is required";
        $b=false;
      } else {
        $username = test_input($_POST["username"]);
         if (!preg_match("/^[a-zA-Z0-9]*$/",$username) || $username=='') {
          $usernameErr = "*Only letters and numbers allowed";
          $b=false; 
        }
      }
  if (empty($_POST["name"])) {
    $nameErr = "*Name is required";
    $b=false;
  } else {
    $name = test_input($_POST["name"]);
     if (!preg_match("/^[a-zA-Z]*$/",$name) || $name=='') {
      $nameErr = "*Only letters allowed ";
      $b=false; 
    }
  }
  

  if (empty($_POST["email"])) {
    $emailErr = "*Email is required";
    $b=false;
  } else {
    $email = test_input($_POST["email"]);
     if (!preg_match("/^[a-zA-Z0-9\.]*@[a-z\.]{1,}[a-z]*$/",$email) || $email=='') {
      $emailErr = "*Enter a Valid Email"; 
      $b=false;
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "*Password is required";
    $b=false;
  } else {
    $password = test_input($_POST["password"]);
     if (!preg_match("/^[a-zA-Z0-9]{10,}$/",$password) || $password=='') {
      $passwordErr = "*Enter minimum 10 characters ";
      $b=false;
    }
  }

  if (empty($_POST["confirm"])) {
    $cpasswordErr = "*Confirmation of Password is required";
    $b=false;
  } else {
    $cpassword = test_input($_POST["confirm"]);
    $password= test_input($_POST["password"]);
    if (strcmp($password,$cpassword)!=0) {
      $cpasswordErr = "*Password does not match ";
      $b=false;
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "*Contact Number is required";
    $b=false;
  } else {
    $phone = test_input($_POST["phone"]);
    if(!preg_match("/^[0-9]{10,10}$/",$phone) || $phone==''){
    	$phoneErr = "*Enter A Valid Contact Number";
    	$b=false;
    }
  }

  

}



if($b==true && isset($_POST['submit']))
{
    $sql = "insert into login(username,password,name,email,phone) values('$username','$password','$name','$email',$phone)";
		$res=$conn->query($sql);
    $sql1="select uid from login where username='$username'";
    $result=$conn->query($sql1);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $_SESSION['username']=$username;
    $_SESSION['type']='normal';
		$_SESSION['id']=$row['uid'];
		header('Location: index2.php'."?user=$username" );
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>HOUSING-CO</title>
	<meta charset="UTF-8">
	<meta name="description" content="HOUSING-CO">
	<meta name="keywords" content="LERAMIZ, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="Styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->

	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top" style = "position:absolute; left:850px; top:15px;">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12 text-lg-right header-top-right">
						<div class="top-social">
							
							<a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
							<a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
							<a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
							<a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
							
						</div>

						<div class="user-panel">
							
							<a href="register.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>User</b></a>
							<a href="reg_builder.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>Consultant</b></a>
							<a href="loginuser.php" style="color:orange;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login</b></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div >
			<div class="row">
				<div >
					<div >
						
						<div style="padding: -30px 20px; " >
							
							<i class="fa fa-bars"></i>
							

						</div>
						<ul class="main-menu" style="margin-left: 60px;">
							<img src="img/space.jpg" alt="" style="width:6%; ">
							<li><a href="index.html" style="color:orange"><i class="fa fa-home"></i>HOME</a></li>
							<li><a href="about.html" style="color:orange"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.html" style="color:orange"><i class="fa fa-envelope" style="color:orange;"></i> CONTACT US</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->

	<style type="text/css">
body{
background-repeat:no-repeat;
background-image:url("img/service-bg1.jpg");
background-size:cover;
background-attachment:fixed;
color:white;
}
input[type=text],input[type=date],input[type=password] {
    border: none;
    border-bottom: 1px solid #fff;
    width: 100%;
    padding: 30px 40px;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size:16px ;
}

 input[type=submit], input[type=reset] {
   border: none;
   outline: none;
   height: 30px;
   width: 100px;
   background-color: #fb2525;
   color: #fff;
   font-size: 20px;
   border-radius: 20px;
   align-items: center;
}



input[type=radio] {
    height: 15px;
    width: 15px;
    
}



select {
	 background-color: #e0e0d1;
    border: none;
    color: black;
    padding: 4px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    font-weight:bold;
    border-radius: 20px;

}
textarea {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    background-color:#e0e0d1;
    color:black;
}
table{
	margin-top: -50px;
 background-color:black;
  border-collapse: collapse; 
  border: 2px solid navy;
  height: 900px;
  width: 700px;
}
form{
opacity:0.7;
}
td{
font-weight:bold;
}
span
{
   color:red;
}

</style>
</head>


 <br><br><br><br><br><br><br><br><br><br><br>
<form id="form" method="post" action="register.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->



<tr>
<td colspan=2>
<center><img src="img/reg_icon.png" style="width: 150px; height:150px;border-radius: 50%; position:absolute;
top: 100px; left:calc(49% - 50px);"></img></center>
</td>
</tr>
<tr>
<td colspan=2>
<center><font size=7 ><b>USER REGISTER FORM</b></font></center>
</td>
</tr>

<tr>
<td><font size=5><b>NAME<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="name" size="30" placeholder="Name">
<span class="error"><?php echo $nameErr; ?></span>
<br><br>
</td>
</tr>
<tr>
<td><font size=5><b>USERNAME<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="username" size="30" placeholder="Username">
<span class="error"><?php echo $usernameErr; ?></span>
<br><br>
</td>
</tr>



<tr>
<td><font size=5>EMAIL ID<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="email"  size="30" placeholder="Email Id">
<span class="error"><?php echo $emailErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5>PHONE NO<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="phone"  size="30" placeholder="Phone no">
<span class="error"><?php echo $phoneErr; ?></span>
  <br><br>
</td>
</tr>



<tr>
<td><font size=5><b>PASSWORD<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="password" size="30" placeholder="Password">
<span class="error"><?php echo $passwordErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b> CONFIRM PASSWORD<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="confirm" size="30" placeholder="Confirm password">
<span class="error"><?php echo $cpasswordErr; ?></span>
  <br><br>
</td>
</tr>



<tr>
<td><input type="reset" value="Reset"></td>
<td><center><input type="submit" value="Register" name="submit"></center>
<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>
<tr><td><a href="loginuser.php" >Already have an account?</a></td></tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>
<!--footer section-->
<footer class="footer-section set-bg" style="background-color:black;border-collapse: collapse; border: 2px solid navy;opacity:0.7; padding:30px 30px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 footer-widget">
					<img src="img/logo1.png" alt="" >
					
					<div class="social">
						
						<a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
							<a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
							<a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
							<a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>

					</div>
					
				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<p>Still delaying your child's health concerns ?</p>
                     <p>Connect with India's top doctors online</p>
					</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title"><center>CONTACT US</center></h5>
						<p><i class="fa fa-map-marker"></i><a href="http://www.spacece.in/"> SPACE-ECE</a></p>
						<p><i class="fa fa-phone"></i>+91 90963 05648</p>
						<p><i class="fa fa-envelope"></i><a href="mailto:events@spacece.co" target="_blank" rel="noopener">contactus@spacece.co</a></p>
						<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6  footer-widget" >
					<div class="newslatter-widget">
						<h5 class="fw-title"><center>NEWSLETTER</center></h5>
						<p>Subscribe your email to get the latest news and new offer also discount</p>
						<form class="footer-newslatter-form">
							<input type="text" placeholder="Email address">
							<button><i class="fa fa-send"></i></button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
     
     </footer>

	<!-- Footer section end -->
     <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p> 
     



<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
  <script src="js/main2.js"></script>

 
</body>
</html>
