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
							<h3 style="color:black;">DashBoard</h3>
						</div>
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						<div class="top-social">
							
							<a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
							<a href="https://www.twitter.com/"><i class="fa fa-twitter" style="color:black;"></i></a>
							<a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
							<a href="https://www.pinterest.com/"><i class="fa fa-pinterest" style="color:black;"></i></a>
							<a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
						
							
						</div>
						<div class="user-panel">
							<a href="logout.php" style="color:orange;"><?php session_start(); echo $_SESSION['username']."  ";?><i class="fa fa-user-circle-o" style="color:black;" ></i>Logout</a>


						</div>
					</div>
				</div>
			</div>
		</div>

		<!--<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="site-navbar">
						<a href="#" class="site-logo"><img src="img/logo1.png" alt="" style="width:40px"></a>
						<div class="nav-switch">
							<i class="fa fa-bars"></i>
						</div>
						<ul class="main-menu">
							


							<li><a href="addup.php">Add Upcoming Projects</a></li>
							<li><a href="upcomingprojects.php">My Upcoming Projects</a></li>
							<li><a href="PackersAndMovers.php">Packers And Movers</a></li>
							
							
						</ul>
					</div>
				</div>
			</div>
		</div>-->
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="img/reg_home.jpg" style="width: 100%; height:550px;">
		<div class="container hero-text text-white">
			<h2></h2>
			<a href></a>
		</div>
	</section>

	<!-- Hero section end -->
	<?php 
	include('indexDB.php');
	$loc=$c='';
	$x1="select distinct location from flat";
	$x2="select distinct city from flat";
	$q="select * from cardsale order by time desc";
	if(isset($_POST['loc']) && isset($_POST['city']))
	{
		$loc=$_POST['loc'];
		$c=$_POST['city'];
		if($loc=='All' && $c=='All')
		{
			$q="select * from cardsale order by time desc";
		}
		if($loc=='All' && $c!='All')
		{
			$q="select * from cardsale where city='$c' order by time desc";
		}
		if($loc!='All')
		{
			$x2="select city from cardsale where location='$loc'";
			$q="select * from cardsale where location='$loc' order by time desc";
		}
	}
	$r1=$conn->query($x1);
	$r2=$conn->query($x2);
	?>

	<!-- Filter form section -->
	<!--<div class="filter-search">
		<div class="container">
			<form class="filter-form" method="post" action="builderHome.php">
			<h2>Search by Location</h2>
			<h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Location   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;City</h4>
				<select name="loc">
					<option value="All" selected>All</option>
					<?php 
					while($p1=mysqli_fetch_array($r1, MYSQLI_ASSOC))
					{
						echo "<option value='".$p1['location']."'>".$p1['location']."</option>";
					}
					?>
				</select>
				<select name="city">
					<option value="All" selected>All</option>
					<?php 
					while($p2=mysqli_fetch_array($r2, MYSQLI_ASSOC))
					{
						echo "<option value='".$p2['city']."'>".$p2['city']."</option>";
					}
					?>
				</select>
				<button class="site-btn fs-submit" type="submit">SEARCH</button>
			</form>
		</div>
	</div>-->
	<!-- page -->
	<section class="page-section categories-page">
		<br><br>
		<h2 align="center">All Properties</h2>
	
			<br><br>
				<div class="container">
			<div class="row">
				<?php
						$r = $conn->query($q);
						while($x=mysqli_fetch_array($r, MYSQLI_ASSOC))
						{
							?>
							<div class='col-md-4' style="height:300px;">
								<form action='single-list_sale.php?action=add&id=<?php echo $x['flat_id']; ?>' method="post">
								<div class='sale-notic'>FOR Sale</div>
									<div class='propertie-info text-white' style="background-image:url('<?php echo $x['image'] ?>');height:270px">
									<div class='info-warp'>
										<p><i class='fa fa-map-marker'></i><?php echo $x['location'] ?></p>
									</div>
									<button class='price' type='submit'><?php echo "Rs. ".$x['totalcost'] ?></button>
									</div>
									</form>
							</div>
				<?php
						}
				?>
			</div>
		</div>
				<br><br>
		<h2 align="center">Your Properties</h2>
		
				<br><br><div class="container">
		<div class="row">
				<?php
						$ab="select * from flat natural join sale where bid=".$_SESSION['id']."";
						$r1 = $conn->query($ab);
						while($y=mysqli_fetch_array($r1, MYSQLI_ASSOC))
						{
							?>
							<div class='col-md-4' style="height:300px;">
								<form action='single-list_sale.php?action=add&id=<?php echo $y['flat_id']; ?>' method="post">
								<div class='sale-notic'>FOR Sale</div>
									<div class='propertie-info text-white' style="background-image:url('<?php echo $y['image'] ?>');height:270px">
									<div class='info-warp'>
										<p><i class='fa fa-map-marker'></i><?php echo $y['location'] ?></p>
									</div>
									<button class='price' type='submit'><?php echo "Rs. ".$y['totalcost'] ?></button>
									</div>
									</form>
							</div>
				<?php
						}
				?>
			</div>
		</div>

<!--display info -->
<div class="container">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Licnes no</th>
                        <th>Email ID</th>
                        <th>Phone no</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include('indexDB.php');
                        $q="select * from login_builder ";
                        $result = $conn->query($q);
                        while($x=mysqli_fetch_array($result, MYSQLI_ASSOC))
                        {
                            echo "<tr>";
                                echo "<td>".$x['username']."</td>";
                                echo "<td>".$x['lno']."</td>";
								echo "<td>".$x['emailid']."</td>";
								echo "<td>".$x['phoneno']."</td>";
                            echo "</tr>";   
                        }
					?>

                </tbody>
            </table>
		</div>


		
<!--sectionclosed-->
















	<footer class="footer-section set-bg" data-setbg="img/footer-bg.jpg">
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

	<!-- Footer section end -->
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