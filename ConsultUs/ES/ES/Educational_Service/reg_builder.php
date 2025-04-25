<?php 
session_start();
include('db_consultus_app.php');
$username = $surname = $email = $password = $cpassword = $phone = $lno = $cat2 = $cat3 = $cat4 = "";

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$usernameErr = $surnameErr = $emailErr = $passwordErr = $cpasswordErr = $phoneErr = $lnoErr= $cat2Err = $cat3Err = $cat4Err = "";
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
		if (empty($_POST["lno"])) {
			$lnoErr = "*License Number is required";
			$b=false;
		} else {
			$lno = test_input($_POST["phone"]);
			if(!preg_match("/^[0-9]{5,10}$/",$phone) || $phone==''){
				$lnoErr = "*Enter only digits";
				$b=false;
			}
  }


   
if (empty($_POST["cat2"])) {
    $cat2Err = "*cat2 is required";
    $b=false;
  } else {
    $cat2= test_input($_POST["cat2"]);
     if (!preg_match("/^[a-zA-Z_ ]*$/",$cat2) || $cat2=='') {
      $cat2Err = "*Only letters allowed ";
      $b=false; 
    }
  }

  if (empty($_POST["cat3"])) {
    $cat3Err = "*cat3 is required";
    $b=false;
  } else {
    $cat3= test_input($_POST["cat3"]);
     if (!preg_match("/^[a-zA-Z_ ]*$/",$cat3) || $cat3=='') {
      $cat3Err = "*Only letters allowed ";
      $b=false; 
    }
  }

  if (empty($_POST["cat4"])) {
    $cat4Err = "*cat4 is required";
    $b=false;
  } else {
    $cat4= test_input($_POST["cat4"]);
     if (!preg_match("/^[a-zA-Z_ ]*$/",$cat4) || $cat4=='') {
      $cat4Err = "*Only letters allowed ";
      $b=false; 
    }
  }





}
if($b==true && isset($_POST['submit']))
{
		$sql = "insert into login_builder(username,lno,password,emailid,phoneno , cat2,cat3,cat4) values('$username', $lno,'$password','$email',$phone,'$cat2','$cat3','$cat4')";
		$res=$conn->query($sql);
		echo "insert done";
    $sql1="select bid from login_builder where username='$username'";
    $result=$conn->query($sql1);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $_SESSION['username']=$username;
    $_SESSION['type']='builder';
		$_SESSION['id']=$row['bid'];
		header('Location: addprojectsale.php');
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
							<a href="reg_builder.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>Specialist</b></a>
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
	margin-top: -120px;
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

<form id="form" method="post" action="reg_builder.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->



<tr>
<td colspan=2>
<center><img src="img/reg_icon.png" style="width: 150px; height:150px;border-radius: 50%; position:absolute;
top: 120px; left:calc(49% - 50px);"></img></center>
</td>
</tr>
<tr>
<td colspan=2>
<center><font size=7><b>CONSULTANT REGISTER FORM</b></font></center>
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
<td><font size=5><b>License number<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="lno" size="30" placeholder="License number">
<span class="error"><?php echo $lnoErr; ?></span>
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






<tr>
<td><font size=5><b>CAT2<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="cat2" size="30" placeholder="Cat2">
<span class="error"><?php echo $cat2Err; ?></span>
<br><br>
</td>
</tr>

<tr>
<td><font size=5><b>CAT3<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="cat3" size="30" placeholder="Cat3">
<span class="error"><?php echo $cat3Err; ?></span>
<br><br>
</td>
</tr>

<tr>
<td><font size=5><b>CAT4<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="cat4" size="30" placeholder="Cat4">
<span class="error"><?php echo $cat4Err; ?></span>
<br><br>
</td>
</tr>

<tr>
	<br><br>
</td>
</tr>






<!--<tr>
	<td><font size=5><b>CATEGORIES<span style="color:red;font-weight:bold">*</span></b></font>
		<td>

	<select name="type">
			
					<option value="cat2" selected>C1</option>
				    <option value="cat3" >C2</option>
				    <option value="cat4" >C3</option>
				 
	</select>
	<br><br>
</td>
</tr>-->






<td><font size=5><b>PASSWORD(lenght<10)<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="password" size="30" placeholder="Password">
<span class="error"><?php echo $passwordErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
<td><font size=5><b>CONFIRM PASSWORD<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="confirm" size="30" placeholder="Confirm password">
<span class="error"><?php echo $cpasswordErr; ?></span>
  <br><br>
</td>
</tr>
<tr>
	<br><br>
</td>
</tr>
<tr>
<td><input type="reset" value="Reset"></td>
<td><input type="submit" value="Register" name="submit">
<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>
<tr><td><a href="loginuser.php" >Already have an account?</a></td></tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>
<footer class="footer-section set-bg" style="background-color:black;border-collapse: collapse; border: 2px solid navy;opacity:0.7;">
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
					<p>We provide you with the best services which is best for your family and which suits your pocket.</p>
					</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title">CONTACT US</h5>
						<p><i class="fa fa-map-marker"></i><a href="http://www.spacece.in/"> SPACE-ECE</a></p>
						<p><i class="fa fa-phone"></i>+91 90963 05648</p>
						<p><i class="fa fa-envelope"></i><a href="mailto:events@spacece.co" target="_blank" rel="noopener">contactus@spacece.co</a></p>
						<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6  footer-widget">
					<div class="newslatter-widget">
						<h5 class="fw-title">NEWSLETTER</h5>
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
     <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p> 

	<!-- Footer section end -->
    <!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script> 
</body>
</html>

