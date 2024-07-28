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

		<div id="preloder">
		<div class="loader"></div>
	</div>
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 header-top-left">
						<div class="top-info ">
							<h3>DashBoard</h3>
						</div>
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						<div class="top-social">
							
							<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
							<a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
							<a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
							<a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
							<a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
						
							
						</div>
						<div class="user-panel">
							<a href="logout.php"><?php session_start(); echo $_SESSION['username']."  ";?><i class="fa fa-user-circle-o"></i>Logout</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
						<a href="#" class="site-logo"><img src="img/logo1.png" alt=""></a>
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
                            <?php 
                            if($_SESSION['type']=='builder')
                            {
                                echo "<li><a href='builderHome.php'>Home</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='normalHomeSale.php'>Home</a></li>";
                            }
                            ?>
                            <?php 
                            if($_SESSION['type']=='builder')
                            {
                                echo "<li><a href='builderHome.php'>FOR SALE</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='normalHomeSale.php'>FOR SALE</a></li>";
                            }
                            ?>
							
             				  <?php if($_SESSION['type']=='builder')
                            {
                                echo "<li><a href='builderHome.php'>FOR RENT</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='normalHomeSale.php'>FOR RENT</a></li>";
                            }
                            ?>
							<li><a href="PackersAndMovers.php">Packers And Movers</a></li>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img/bg.jpg">
	</section>

	<!-- Hero section end -->
	<?php 
	include('db_consultus_app.php');
    if($_SESSION['type']=='builder')
    {
        $q="select * from upcoming_projects where bid=".$_SESSION['id']."";
    }
    else
    {
        $q="select * from upcoming_projects";
    }
    $res=$conn->query($q);
	?>
	<!-- page -->
	<section class="page-section categories-page">
    <br><br><br><br>
    <div class="container">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Name of Builder</th>
                        <th>Location</th>
                        <th>City</th>
                        <th>Estimated Completion Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($x=mysqli_fetch_array($res, MYSQLI_ASSOC))
                        {
                            $q1="select nameorg from login_builder where bid=".$x['bid']."";
                            $r1=$conn->query($q1);
                            $p1=mysqli_fetch_array($r1, MYSQLI_ASSOC);
                            echo "<tr>";
                                echo "<td>".$p1['nameorg']."</td>";
                                echo "<td>".$x['location']."</td>";
                                echo "<td>".$x['city']."</td>";
                                echo "<td>".$x['comp_time']." Months</td>";
                            echo "</tr>";   
                        }
					?>
                </tbody>
            </table>
		</div>
	</section>

	<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 footer-widget">
					<img src="img/logo1.png" alt="">
					<p>We provide you with the best services which is best for your family and which suits your pocket.</p>
					<div class="social">
						
						<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
							<a href="https://www.twitter.com/"><i class="fa fa-twitter"></i></a>
							<a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
							<a href="https://www.pinterest.com/"><i class="fa fa-pinterest"></i></a>
							
					</div>
				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title">CONTACT US</h5>
						<p><i class="fa fa-map-marker"></i>You can contact us here......  </p>
						<p><i class="fa fa-phone"></i>Number</p>
						<p><i class="fa fa-envelope"></i>info.housing-co@gmail.com</p>
						<p><i class="fa fa-clock-o"></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="double-menu-widget">
						<h5 class="fw-title">POPULAR PLACES</h5>
						<ul>
							<li><a href="">Mumbai</a></li>
							<li><a href="">Delhi</a></li>
							<li><a href="">Chennai</a></li>
							<li><a href="">Kolkata</a></li>
							<li><a href="">Banglore</a></li>
						</ul>
						<ul>
							<li><a href="">Chandigarh</a></li>
							<li><a href="">Pune</a></li>
							<li><a href="">Jaipur</a></li>
							<li><a href="">Kochi</a></li>
							<li><a href="">Ooty</a></li>
						</ul>
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