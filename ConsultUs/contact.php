<?php
include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>SPAC-ECE</title>
	<meta charset="UTF-8">
	<meta name="description" content="SPACE-ECE">
	<meta name="keywords" content="LERAMIZ, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/Favicon.ico" rel="shortcut icon"/>

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
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section
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
							<li><a href="index.html" style="color:white"><i class="fa fa-home"></i>HOME</a></li>
							<li><a href="about.html" style="color:white"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.html" style="color:white"><i class="fa fa-envelope" style="color:white;"></i>FEEDBACK</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header> -->
	<!-- Header section end -->
<!-- Page succsess msg section -->

<!-- end section -->
	<!-- Page top section -->
	<section class="page-top-section set-bg" data-setbg="img/about.jpg" style="width: 100%; height: 45%;">
		<div class="container text-black" >
			<h3>PLEASE GIVE YOUR FEEDBACK</h3>
		</div>
	</section>
	<!-- Breadcrumb 
	<div class="site-breadcrumb">
		<div class="container">
			<a href=""><i class="fa fa-home"></i>Home</a>
			<span><i class="fa fa-angle-right"></i>Contact us</span>
		</div>
	</div>

	page --> 
	<section class="page-section blog-page" style="margin-top: 10vh;">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<img src="img/contact.jpg" alt="">
				</div>
				<div class="col-lg-6">
				<?php
					if (isset($_COOKIE['success_msg'])) {
						echo "
							<div class='alert alert-success'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<b>". $_COOKIE['success_msg'] . "</b>
							</div>
						";
					}
					?>
					<div class=" ">
						<div class="section-title">
							<h3>FEEDBACK FORM</h3>
						</div>
						<form class="contact-form d-flex justify-content-center" method="POST"  action="feedback.php">
							<div class="row">
								<div class="col-md-5">
									<span>fullname</span>
									<input type="text"class="form-control" name= "fullname" placeholder="Your name" >
								</div>
								<div class="col-md-6">
								<span>Your email</span>
									<input type="email" placeholder="Your email" name="email">
								</div>
								<div class="col-md-12">
								<span>Your message</span>
									<textarea  placeholder="Your message"  name= "feedback"></textarea>
									<button class="site-btn">SUBMIT NOW</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- page end -->
			  <div class="container-fluid">
			    	    <div class="map-responsive" style=" 
										    overflow:hidden;
										    padding-bottom:50%;
										    position:relative;
										    height:0;
										">
			    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d3784.7339915220646!2d73.80759426484163!3d18.45038313744994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sC1%20Chandralok%20Nagari%2C%20Sitaee%20Nagar%2C%20Dhayari%20Phata%2C%20Pune%2C%20Maharashtra%20411041%2C%20India!5e0!3m2!1sen!2sin!4v1628857382605!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;
												    left:0;
												    top:0;
												    height:100%;
												    width:100%;
												    position:absolute;
												" allowfullscreen></iframe>
			</div>			</div> 

<?php
include_once '../common/footer_module.php';
?>
	<!-- Footer section -->
	<!-- <footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
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
						<p><i class="fa fa-map-marker"><a href="http://www.spacece.in/"> SPACE-ECE</a></i></p>
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
	</footer> -->

	<!-- Footer section end -->
       <!-- <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></p>                                -->
	<!--====== Javascripts & Jquery ======-->
	<!-- <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script> -->

	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
	<script src="js/map.js"></script>
</body>
</html>