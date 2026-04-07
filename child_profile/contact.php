<?php include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>

   <title>CITS | Contact us</title>
    <link href="css/style2.css" rel="stylesheet" type="text/css"  media="all" />
    <link href='http://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/jquery-ui.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
</head>
    <body style="background-color: lightblue">
		<!--start-wrap-->
		
			<!--start-header-->
			<div class="header">
				<div class="wrap">
				<!--start-logo-->
				<div class="logo">
		<a style="font-size: 30px;color: white;" href="home.php">Child Immunization Tracking System</a> 
				</div>
				<!--end-logo-->
				<!--start-top-nav-->
				<div class="navbar-right">
					<ul>
						<li><a style="color: black;" href="home.php"><i class="fa fa-home"></i> Back Home</a></li>
					</ul>					
				</div>
				<div class="clear"> </div>
				<!--end-top-nav-->
    <!-- Page Content -->
    <div style="color: black;" class="container" style="margin-top:10px;">

			<div style="color: black;" class="row">
				<div class="col-md-8">
				<?php
					if(isset($_POST["submit"]))
					{
					 $sql="INSERT INTO messages (NAME, CONTACT, EMAIL, MESSAGE, STATUS,LOGS) VALUES ('{$_POST["name"]}', '{$_POST["phone"]}', '{$_POST["email"]}', '{$_POST["message"]}', 1,NOW());";
						if($con->query($sql))
				{
					echo '
					<div class="alert alert-success">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Success!</strong> Your message has been Successfully sent.
					</div>
					
					
					';
				}
					}
				?>
		
				<h3 class='text-primary'>Talk to Us!</h3>
                <form method="post" action="contact.php" role="form" >
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input type="text" class="form-control" name="name" required>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" name="email"  >
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea rows="5" cols="100" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button style="background-color: skyblue;" type="submit" class="btn btn-primary" name="submit"><i class='fa fa-send'></i> Send Message</button>
                </form>
				
			</div>
			
            <div class="col-md-4">
                <h3 style="color: black;" class='text-primary'>Contact Details</h3>
                <p>
                    CITS<br>
					34/44 ,Buma Street,<br>
					Ngong Rd-0100.<br>
					Nairobi.
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Phone">Phone</abbr>: +886669833</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Email">Email</abbr>: <a href="#" >info@cits.com</a>
                </p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>


        <hr>
		
<div class="clear"> </div>
		   <div class="footer">
		   	 <div class="wrap">
		   	<div class="footer-center">
		   			<div  style="text-align: center;  color: black; font-size: 13pt" class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> 2021 CITS</span>. <span>All rights reserved</span>
					</div>
		   	</div>
		  
		   	<div class="clear"> </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

   

</body>

</html>
