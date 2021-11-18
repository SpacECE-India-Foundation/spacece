<?php
include_once './includes/header1.php';
include('indexDB.php');

if(isset($_POST['submit']))
{
	echo $user_name = $_POST['username'];
	echo $category = $_POST['category'];
	echo $office = $_POST['office'];
	echo $phone = $_POST['phone'];
	echo $ctime = $_POST['ctime'];
        echo $stime = $_POST['stime'];
	echo $pass = $_POST['password'];
	echo $fee = $_POST['consfee'];
	echo $lno = $_POST['lno'];
             $email = $_POST['email'];

$sql = "INSERT INTO `consultant`( `name`, `category`, `office`, `mobile`, `ctime`,`consfee`, `pass`, `lno`, `stime`, `email`) VALUES ('$user_name','$category','$office','$phone','$ctime','$fee','$pass','$lno','$stime','$email')";
$res = mysqli_query($conn,$sql);
if($res){
		echo "insert done";

	/*$sql1="select c_id from consultant where username='$user_name'";
    $result=$conn->query($sql1);
    $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
    $_SESSION['username']=$user_name;
    $_SESSION['type']=$category;
		$_SESSION['id']=$row['c_id'];*/
		header('Location: index3.php'."?user=$user_name");}
   
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
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="Styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->

	
	<!-- Header section -->
	<!-- <header class="header-section">
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
	</header> -->
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
    height: 20px;
    width: 50px;

    
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
<td><input type="text" name="username" size="300" placeholder="Username">
<br><br>
</td>
</tr>
<tr>
<td><font size=5><b>License number<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="lno" size="30" placeholder="License number">
<br><br>
</td>
</tr>
<tr>
<td><font size=5>Office_Address<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="office"  size="300" placeholder="Address">
  <br><br>
</td>
</tr>
<tr>
<td><font size=5>PHONE NO<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="phone"  size="30" max="11" id="mobile" onBlur="validPhone(this)" placeholder="Phone no">
<span id="message"><br><br>
</td>
</tr>
<td><font size=5>EMAIL<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="email"  size="30" placeholder="Email">
  <br><br>
</td>
</tr>

<td><font size=5>Specialist In<span style="color:red;font-weight:bold">*</span></font></td>
<?php 
$link=mysqli_connect("localhost","root","");

mysqli_select_db($link,"consultant_app");
?>
<tr>
<td>
<select name="category" id="category">

	<?php
	$res=mysqli_query($link,"SELECT DISTINCT `category` FROM `consultant`");
	while($row=mysqli_fetch_array($res))
{
	?>

	<option><?php echo $row["category"]; ?></option>
	<?php
}
?>
</select>
</td>
</tr>
</tr>
<tr>
<td><font size=5>Consultation Time(from)<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="time" name="ctime"   placeholder="enter time">

</td>
</tr>

<tr>
<td><font size=5>Consultation Time(to)<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="time" name="stime"   placeholder="enter time">
</td>
</tr>
<!-- // bug Id-0000073 -->
<tr>
<td><font size=5>Consultation fee<span style="color:red;font-weight:bold">*</span></font></td>
<td><input type="text" name="fee"   placeholder="enter fee">
</td>
</tr>

<!-- //bug Id-0000075 -->

<tr>
<td><font size=5><b>PASSWORD(lenght<10)<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="password" id="regPassword" onblur="validatePassword()" maxlength="6"   placeholder="Password">
<div class="messageBox">
  <br><br>
</td>
</tr>

<tr>

	<!-- //bug Id-0000075 -->
<td><font size=5><b>CONFIRM PASSWORD<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="confirm" size="30"  onblur="validatePassword()" maxlength="6" placeholder="Confirm password">
<div class="messageBox"> <br><br>
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
<!-- 0000042 -->
<tr><td><a href="loginuser.php" >Already have an account?</a></td></tr>
</table>
<br><br><br><br><br><br><br><br><br><br>
</form>
<?php
include_once './includes/footer1.php';

?>

<!-- footer section
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
     
     </footer> -->
<!--footer end-->
     <!-- <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p>  -->

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

