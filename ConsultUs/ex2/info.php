<!DOCTYPE html>
<html lang="en">
<head>
	<title>HOUSING-CO</title>
	<meta charset="UTF-8">
	<meta name="description" content="LERAMIZ Landing Page Template">
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
	<link rel="stylesheet" href="css/magnific-popup.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<style type="text/css">
body,html {
  height: 100%;
 }

body {
  padding-top: 50px;


}

#myBtn{
  display: none;
  position: fixed;
  bottom: 20px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: green;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 10px;
}
#myBtn:hover {
  background-color: darkgreen;
  color: white;
}

.bg-4{
  background-color: #2f2f2f;
  color: #ffffff;

}

footer{
  display: block;
}

</style>
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section" style="margin-left:90px 70px;">
		<div class="header-top">
			
				<div class="row">
					<div class="col-lg-6 header-top-left">
					</div>
					<div class="col-lg-6 text-lg-right header-top-right">
						<div class="top-social">
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter" style="color:black;"></i></a>
							<a href=""><i class="fa fa-instagram"></i></a>
							<a href=""><i class="fa fa-pinterest" style="color:black;"></i></a>
							<a href=""><i class="fa fa-linkedin"></i></a>
						</div>
						<div class="user-panel">
							<a href="logout.php" style="margin-right: 60px;color: orange;"><?php session_start(); echo $_SESSION['username']."  ";?><i class="fa fa-sign-in"style="margin-right: 50px;color: orange;"></i> Logout</a>
						</div>
					</div>
				</div>
			
		</div>
	
	<!-- Header section end -->


	<!-- Page top section -->





  <?php
include('indexDB.php');
$x=$_GET["id"];
$sql = "SELECT * FROM flat natural join sale where flat_id=$x";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);
$q='';$a;
if($_SESSION['type']=='normal')
{
  $a=1;
  $q="select name,surname from login where uid=".$row['uid']."";
}
else
{
  $a=2;
  $q="select nameorg from login_builder where bid=".$row['bid']."";
}
$a="SELECT totalcost FROM SALE where flat_id=$x";
$r1 = $conn->query($a);
$r2 = mysqli_fetch_assoc($r1);
$_SESSION["amt"]=$r2['totalcost'];
$b="SELECT name from login where UID=(SELECT uid from flat where flat_id=$x)";
$r4=$conn->query($b);
$r5= mysqli_fetch_assoc($r4);
$_SESSION["buyer"]=$r5['name'];
$_SESSION["flat_id"]=$x;
?>
	<!-- Page -->
	<section class="page-section" style="padding:70px 69px;">
		
			<div class="row">
				<div class="col-lg-8 single-list-page">
					<!--<div class="single-list-slider owl-carousel" id="sl-slider">
            <div class="sl-item set-bg" data-setbg=""></div>
            <div class="sl-item set-bg" data-setbg=""></div>
						<div class="sl-item set-bg" data-setbg=""></div>
						<div class="sl-item set-bg" data-setbg=""></div>
          </div>
          <div class="owl-carousel sl-thumb-slider" id="sl-slider-thumb">
						<div class="sl-thumb set-bg" data-setbg=""></div>
						<div class="sl-thumb set-bg" data-setbg=""></div>
						<div class="sl-thumb set-bg" data-setbg=""></div>
						<div class="sl-thumb set-bg" data-setbg=""></div>
					</div>-->
          <div class="single-list-content">
						<div class="row">
							<div class="col-xl-8 sl-title">
								<h2><?php echo $row['location'] ?></h2>
								<p><i class="fa fa-map-marker"></i><?php echo $row['city'] ?></p>
							</div>
							
						</div>
						<h3 class="sl-sp-title">Property Details</h3>
						<div class="row property-details-list">
							<div class="col-md-4 col-sm-6">
								<p><i class="fa fa-th-large"></i><?php echo "Area:&nbsp;&nbsp;&nbsp;".$row['area']." sqft" ?></p>
								
                
							</div>
							<div class="col-md-4 col-sm-6">
								<p><i class="fa fa-th-large"></i><?php echo "Rate:&nbsp;&nbsp;&nbsp;".$row['rate']." per sqft"?></p>
								
                
							</div>
						</div>
						<h3 class="sl-sp-title">Description</h3>
						<div class="description">
							<p><?php echo $row['description'] ?></p>
							</div>
						<h3 class="sl-sp-title">Property Amenities</h3>
						<div class="row property-details-list">
							<div class="col-md-12 col-sm-6">
								<p><i class="fa fa-check-circle-o"></i><?php echo $row['amenities'] ?></p>
							</div>
						</div>
						<div class="col-xl-4">
								<a href="payment.php" class="price-btn"><?php echo "Rs. ".$row['area']."/-" ?></a>
							</div>
						
          </div>
        </div>
        


          <?php
        include('indexDB.php');
        	$x=$_GET["id"];
        	$sql1="SELECT * FROM flat natural join sale where flat_id=$x";
        	$result1 = $conn->query($sql1);
			$row1 = mysqli_fetch_assoc($result1);
			$b=0;$q1='';
			if($row1['bid']==NULL)
			{
				if($row1['uid']!=NULL)
				{
					$y=$row1['uid'];
				//echo "UID".$row1['uid'];
			//	echo $y;
				$b=1;
				//echo $b;
				}
			}
			if($row1['uid']==NULL)
			{
				if($row1['bid']!=NULL)
				{
					$y=$row1['bid'];
				//echo "BID".$row1['bid'];
				//echo $y;
				$b=2;
				//echo $b;
				}
			}
			if($b==1)
			{
				$q1="select * from login where UID=".$row1['uid']."";
				$_SESSION["save"] =$row1['uid'] ;

			}
			else if($b==2)
			{
				 $q1="select * from login_builder where BID=".$row['bid']."";
				 $_SESSION["save"] =$row1['bid'] ;
			}
			$res1=$conn->query($q1);
			$r1= mysqli_fetch_assoc($res1);
        	
        ?>

     

        <div class="col-lg-4 col-md-7 sidebar">
					
					<div class="contact-form-card">
						<h5>Please Give Your Feedback</h5>

						<form id="form" method="post">
							<input type="text" name="name" placeholder="Your name">
							<input type="text" name="email" placeholder="Your email">
							<textarea name="question"placeholder="Feedback"></textarea>
							<button name="send" >SEND</button>
						</form>

							<?php
    include('indexDB.php');
    if(isset($_POST['name']))
    {
   		$name=$_POST['name'];
    }
    if(isset($_POST['email']))
    {
    	$email=$_POST['email'];
    }
    if(isset($_POST['question']))
    {
    	$question=$_POST['question'];
    }
    $id='';
    $c;
  
    if($_SESSION['type']=='normal')
    {
    	$c=1;
        $id=$row1['uid'];
    }
    else
    {
        $c=2;
        $id=$row1['bid'];
    }
    if($c==1)
    {
    	if(isset($_POST['send']))
    	{
    	 $q1="insert into feedbackuser(val,name,email,question) values(".$_SESSION['id'].",'$name','$email','$question')";
    	}
        $result1 = $conn->query($q1);
    }
    else
    {
    	if(isset($_POST['send']))
    	{
    	 $q1="insert into feedbackbuilder(val,name,email,question) values(".$_SESSION['id'].",'$name','$email','$question')";
    	}
        $result1 = $conn->query($q1);
    }
?>

      </div>
		</div>
	</section>
	<!-- Page end -->


	<!-- Clients section -->
	<!--<div class="clients-section">
		<div class="container">
			<div class="clients-slider owl-carousel">
				<a href="#">
					<img src="img/partner/1.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/2.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/3.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/4.png" alt="">
				</a>
				<a href="#">
					<img src="img/partner/5.png" alt="">
				</a>
			</div>
		</div>
	</div>-->
	<!-- Clients section end -->


	<!-- Footer section -->
<footer class="footer-section set-bg" style="background-color:black;border-collapse: collapse; border: 2px solid navy;opacity:0.7; padding:30px 30px;">
		
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
			
		
     
     </footer>
	<!-- Footer section end -->

	<p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p>

                                        
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>


	<!-- load for map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0YyDTa0qqOjIerob2VTIwo_XVMhrruxo"></script>
	<script src="js/map-2.js"></script>

</body>
</html>