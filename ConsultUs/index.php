<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
?>

<!-- Page Preloder -->
<div id="preloder">
	<div class="loader"></div>
</div>



</script>
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
							<a href="reg_builder.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>Consultant</b></a><br>
							<a href="loginuser.php" style="color:orange;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login USER</b></a>
							<a href="login2.php" style="color:orange;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login Consultant</b></a>
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
							<li><a href="http://educationfoundation.space/spacece/c_index.html" style="color:black;"><i class="fa fa-home"></i>HOME</a></li>
							<li><a href="about.html" style="color:black;"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.php" style="color:black;"><i class="fa fa-envelope" style="color:black;"></i> FEEDBACK</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header> -->
<!-- Header section end -->






<!-- Hero section -->
<div class=" set-bg; output" data-setbg="" style="width:10; border-radius: 1%; ">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class=" " src="../img/d7.jpg" alt="First slide"style="width:100% " >
			</div>
			<div class="carousel-item">
				<img class="d-block" src="../img/d8.jpg" alt="Second slide" style="width:100%;">
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

</div>
<br><br><br>




<!-- Hero section end -->
<!-- Services section -->
<!--<section class="services-section spad set-bg" data-setbg="img/org.png">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">				
					<img src="img/service.jpg" alt="">
				</div>
				<div class="col-lg-5 offset-lg-1 pl-lg-0">
					<div class="section-title text-white">
						<h3>OUR SERVICES</h3>
						<p>We provide the perfect service for </p>
					</div>
					<div class="services">
						<div class="service-item">
						<i class="fa fa-comments"></i>
								<div class="service-text">
								<h5>Consultant Service</h5>
								<p>We provide you with the best services which is best for your family and which suits your pocket.</p>
							</div>
						</div>
						<div class="service-item">
							<i class="fa fa-home"></i>
							<div class="service-text">
								<h5>Properties Management</h5>
								<p>We manage your property considering as our own and give you the best possible solution regarding it.</p>
							</div>
						</div>
						<div class="service-item">
							<i class="fa fa-briefcase"></i>
							<div class="service-text">
								<h5>Renting and Selling</h5>
								<p>Enjoying various services provided by us without any mid-man, Book your dream home today!.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>-->
<!-- Services section end -->
<!-- Blog section --><br><br>
<section class="blog-section spad">
	<div class="container">
		<div class="section-title text-center">
			<h3>TOP SPECIALTIES</h3>
			<p>Connect with India's top doctor consultant for your child</p>
		</div>
		<div class="row">
		<?php

 $servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "consultant_app";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$check = "SELECT * FROM consultant_category ";
$run = mysqli_query($conn, $check);

if (mysqli_num_rows($run) > 0) {
   while($row=mysqli_fetch_assoc($run)){

  ?>
 
			<div class="col-lg-4 col-md-6 blog-item">
				<!-- //bug id-0000076 -->
				<a href="cdetails.php?category=<?php echo $row['cat_name'];?>">
					<img src="../img/consult_category/<?php echo $row['cat_img'];?>" alt="" width="500" height="200"></a>
				<h5><a href="#"> </a></h5>
				<div class="blog-meta">
					<!--<span><i class="fa fa-user"></i>Manas Sinkar</span>
						<span><i class="fa fa-clock-o"></i>25 Jan 2019</span>-->
				</div>
				<p> </p>
			</div>
	<?php	}
	}else{
	die();
	}
	?>
			
		</div>
	</div>
</section>
<!-- Blog section end -->

<!-- Clients section -->
<!--<div class="clients-section" >
		<div class="container" >
			<div class="clients-slider owl-carousel" style="background-color: or;">
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


<!--Benefits-->

<div class="section col" style="width: 100%; ">
	<div class=" text-center">
		<h3>BENEFITS OF ONLINE CONSULTATION</h3>
		<p></p>
	</div>
	<div class="row">
		<div class="col-lg-4 col-md-6 blog-item">

			<p><i class="fa fa-check-circle" style="color:black;"></i>Get a second opinion</p>
		</div>


		<div class="col-lg-4 col-md-6 blog-item">

			<p><i class="fa fa-check-circle" style="color:black;"></i>Access to specialists</p>
		</div>

		<div class="col-lg-4 col-md-6 blog-item">

			<p><i class="fa fa-check-circle" style="color:black;"></i>Privacy & availability</p>
		</div>

		<div class="col-lg-4 col-md-6 blog-item">

			<p><i class="fa fa-check-circle" style="color:black;"></i>Comfort and convenience</p>
		</div>
		<div class="col-lg-4 col-md-6 blog-item">
			<p><i class="fa fa-check-circle" style="color:black;"></i>Cost-effective and time-saving</p>
		</div>

		<div class="col-lg-4 col-md-6 blog-item">
			<p><i class="fa fa-check-circle" style="color:black;"></i>No need to save all the medical reports</p>
		</div>


	</div>
</div>


<!---benefits section close-->

<!-- fixed bug id 0000100 -->
<!---offers section-->
<div class="section col" style="width: 100%; ">
	<div class="text-center">
		<div class="section-title text-center">
			<h3>GET THE BEST OFFERS HERE</h3>
			<p></p>
		</div>
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="../img/o1.jpg" alt="First slide" style="width: 100%; height: 10%;">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="../img/o2.jpg" alt="Second slide" style="width: 100%; height: 30%;">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>
<br><br>


<!---offers close-->














<!-- ChatBot -->
<div class="chat_icon">
	<i class="fa fa-comments" aria-hidden="true" style="color:black ;border:2px solid black	;"></i>
</div>

<div class="chat_box">
	<div class="my-conv-form-wrapper">
		<form action="" method="GET" class="hidden">

			<select data-conv-question="Hello! How can I help you" name="category">
				<option value="WebDevelopment">Website Development ?</option>
				<option value="DigitalMarketing">Digital Marketing ?</option>
			</select>

			<div data-conv-fork="category">
				<div data-conv-case="WebDevelopment">
					<input type="text" name="domainName" data-conv-question="Please, tell me your domain name">
				</div>
				<div data-conv-case="DigitalMarketing" data-conv-fork="first-question2">
					<input type="text" name="companyName" data-conv-question="Please, enter your company name">
				</div>
			</div>

			<input type="text" name="name" data-conv-question="Please, Enter your name">

			<input type="text" data-conv-question="Hi {name}, <br> It's a pleasure to meet you." data-no-answer="true">

			<input data-conv-question="Enter your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" name="email" required placeholder="What's your e-mail?">

			<select data-conv-question="Please Conform">
				<option value="Yes">Conform</option>
			</select>

		</form>
	</div>
</div>
</div>


<!--session close-->


<!-- Footer section -->
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
					<p style="color:black";>Still delaying your child's health concerns ?</p>
                     <p style="color:black";>Connect with India's top doctors online</p>
					</div>
				<div class="col-lg-3 col-md-6 footer-widget">
					<div class="contact-widget">
						<h5 class="fw-title" style="color:black";><center>CONTACT US</center></h5>
						<p style="color:black";><i class="fa fa-map-marker"></i><a href="http://www.spacece.in/" style="color:black";> SPACE-ECE</a></p>
						<p style="color:black";><i class="fa fa-phone" style="color:black";></i>+91 90963 05648</p>
						<p style="color:black";><i class="fa fa-envelope" style="color:black";></i><a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="color:black";>contactus@spacece.co</a></p>
						<p style="color:black";><i class="fa fa-clock-o"style="color:black";></i>Mon - Sat, 08 AM - 06 PM</p>
					</div>
				</div>
				
				<div class="col-lg-3 col-md-6  footer-widget" >
					<div class="newslatter-widget">
						<h5 class="fw-title" style="color:black";><center>NEWSLETTER</center></h5>
						<p style="color:black";>Subscribe your email to get the latest news and new offer also discount</p>
						<form class="footer-newslatter-form">
							<input type="text" placeholder="Email address">
							<button><i class="fa fa-send"></i></button>
						</form>
					</div>
				</div>
			</div>
			
		</div>
     
     </footer> -->
<!-- <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p>                                     -->
<!--====== Javascripts & Jquery ======-->
<!-- <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script> -->


<!-- <script type="js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="js/jquery-3.1.1.min.js"> -->
<!-- </script> -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>







<script src='js/masonry.pkgd.min.js'></script>
	<script src='js/magnific-popup.min.js'></script>
<script  src='../js/jquery.convform.js'></script>
<script src='js/main.js'></script>
<script src='../js/owl.carousel.min.js'></script>
<script type="text/javascript" src="js/jquery.convform.js">
</script>
<script type="text/javascript" src="js/custom.js"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<!-- <script type="text/javascript">
	$(document).ready(function() {


		setInterval(function() {
			let user = "<?php echo $_GET['user']; ?>";
			//alert(user);
			//$('#call').replaceWith("");
			$.ajax({
				url: './video.php',
				type: 'POST',
				data: {
					user: user,
					getCall: 1
				},
				success: function(data) {
					// console.log(data);
					// alert(data);
					//$('#call').html(data);
				}
			});

		}, 5800);

	})
</script> -->


<?php
// $module_logo = "../img/logo/ConsultUs.jpeg";
include_once '../common/footer_module.php';

?>