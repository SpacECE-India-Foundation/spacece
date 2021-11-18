<?php
   include_once './includes/header1.php';

   include("indexDB.php");
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    $username='';$password='';$b=true;
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['username']))
				$username=test_input($_POST['username']);
				else $b=false;
        if(isset($_POST['password']))
				$password=test_input($_POST['password']);
				else $b=false;
        if(isset($_POST['type']))
						$type=test_input($_POST['type']);
						else $b=false;
				$tablename='';$id='';
				if(empty($_POST['username']))
				$b=false;
				if($b==false)
				{
					header('Location: loginuser.php');
				}
        if($type=='normal')
        {
            $id='uid';
            $tablename='login';
        }
        else if($type=='builder')
        {
            $id='bid';
            $tablename='login_builder';
        }
        $q="select $id,password from $tablename where username='$username'";
        echo $q;
        $result=$conn->query($q);
        if($result==true)
        {
            $row= mysqli_fetch_array($result,MYSQLI_ASSOC);
        }
        else
        {
				//	header('Location: loginuser.php');  ...CHANGES REMOVE SLASH
        }
        if($row['password']==$password)
        {
            $_SESSION['username']=$username;
            $_SESSION['type']=$type;
            if($id=='uid' && $b==true)
            {
                $_SESSION['id']=$row['uid'];
               header('Location:index2.php'."?user=$username");
			  }
            if($id=='bid' && $b==true)
            {
                $_SESSION['id']=$row['bid'];
                header('Location:index3.php'."?user=$username");
            }
        }
        else
        {
            echo "Invalid Password!!!!";
            header('Location: loginuser.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>LOGIN USER</title>
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
	<header class="header-section" style="background-color:orange;">
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
							
							<a href="register.php" style="color:black;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>User</b></a>
							<a href="reg_builder.php" style="color:black;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>Consultant</b></a>
							<a href="loginuser.php" style="color:black;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login</b></a>
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
							<li><a href="index.html" style="color:black"><i class="fa fa-home"></i>HOME</a></li>
							<li><a href="about.html" style="color:black"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.html" style="color:black"><i class="fa fa-envelope" style="color:black;"></i> CONTACT US</a></li>
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
background-image:url("img/child.jpg");
background-size:cover;
background-attachment:fixed;
color:white;
}
input[type=text],input[type=date],input[type=password] {
    border: none;

    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size:16px ;
}

 input[type=reset] {
   border: none;
   outline: none;
   height: 30px;
   width: 100px;
   background-color: orange;
   color: #fff;
   font-size: 20px;
   border-radius: 20px;
   align-items: center;
}

input[type=submit]{
   border: none;
   outline: none;
   height: 30px;
   width: 200px;
   background-color: orange;
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
 background-color:black;
  border-collapse: collapse; 
  border: 2px solid navy;
  height: 600px;
  width: 500px;
}
form{
opacity:0.7;

}
td{
font-weight:bold;
}
span
{
   color:black;
}

</style>
</head>


 <br><br><br><br><br><br><br><br><br><br><br>

<form id="form" method="post" action="loginuser.php" >

<table cellpadding="7" width="50%" border="0" align="center"cellspacing="2" color="white">

    <!-- I want another button here, center to the tile-->



<tr>
<td colspan=2>
<center><img src="img/login_icon.png" style="width: 150px; height:150px;border-radius: 50%; position:absolute;
top: 160px; left:calc(49% - 50px);"></img></center>
</td>
</tr>
<tr>
<td colspan=2>
<center><font size=6><b>LOGIN HERE</b></font></center>
</td>
</tr>


<tr>
<td><font size=5><b>USERNAME<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="text" name="username" size="30" placeholder="USERNAME">
<span class="error"></span>
<br><br>
</td>
</tr>




<tr>
<td><font size=5><b>PASSWORD<span style="color:red;font-weight:bold">*</span></b></font></td>
<td><input type="password" name="password" size="30" placeholder="Password">
<span class="error"></span>
  <br><br>
</td>
</tr>

<tr>
	<td><font size=5><b>OPTIONS<span style="color:red;font-weight:bold">*</span></b></font>
		<td>

	<select name="type">
			
					<option value="normal" selected>NORMAL USER</option>
				 
	</select>
	<br><br>
</td>
</tr>








<tr style="padding : 20px 50px;">
<td><input type="reset" value="Reset"></td>
<td><input type="submit" value="Login" >


<div style = "font-size:20px; color:#cc0000; margin-top:10px"></div>
</td>
</tr>

<tr><td><a href="index.html" >Don't have an account?</a></td></tr>

</table>
<br><br><br><br><br><br><br><br><br><br>
</form>

<!--footer section-->
<!-- <footer class="footer-section set-bg" style="background-color:orange;border-collapse: collapse; border: 2px solid navy;opacity:0.7; padding:30px 30px;">
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
					<p style="color:black;">Still delaying your child's health concerns ?</p>
                     <p style="color:black;">Connect with India's top doctors online</p>
					</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title" style="color:black;"><center>CONTACT US</center></h5>
						<p style="color:black;"><i class="fa fa-map-marker" style="color:black;"></i><a href="http://www.spacece.in/" style="color:black;"> SPACE-ECE</a></p>
						<p style="color:black;"><i class="fa fa-phone" style="color:black;"></i>+91 90963 05648</p>
						<p style="color:black;"><i class="fa fa-envelope" style="color:black;"></i><a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="color:black;">contactus@spacece.co</a></p>
						<p style="color:black;"><i class="fa fa-clock-o" style="color:black;"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6  footer-widget" >
					<div class="newslatter-widget">
						<h5 class="fw-title" style="color:black;"><center>NEWSLETTER</center></h5>
						<p style="color:black;">Subscribe your email to get the latest news and new offer also discount</p>
						<form class="footer-newslatter-form">
							<input type="text" placeholder="Email address" style="color:black;border:1px solid black;">
							<button style="border:1px solid black;background-color:green;"><i class="fa fa-send" style="color:white;opacity:0.9;"></i></button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
     
     </footer>

	
     <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p> 
     <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15"><span style="text-decoration:underline"><a href="mailto:events@spacece.co" target="_blank" rel="noopener">contactus@spacece.co</a></span></span></span></p>  
 -->

<?php
   include_once './includes/footer1.php';

?>
 
</body>
</html>
