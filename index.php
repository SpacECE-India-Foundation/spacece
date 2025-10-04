<?php
//  
$main_logo = "./img/logo/SpacECELogo.jpg";
$module_logo = null;
$module_name = null;
$main_page = true;

$extra_styles = "<link rel='stylesheet' href='./css/bootstrap.min.css' />
<link rel='stylesheet' href='./css/font-awesome.min.css' />
<link rel='stylesheet' href='./css/animate.css' />
<link rel='stylesheet' href='./css/owl.carousel.css' />
<link rel='stylesheet' href='./css/style.css' />
<link
  rel='stylesheet'
  href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
/>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>

<link rel='stylesheet' type='text/css' href='./Styles.css' />
<link rel='stylesheet' type='text/css' href='./css/jquery.convform.css' />
<link rel='stylesheet' type='text/css' href='./css/responsive.css' />
<link rel='stylesheet' type='text/css' href='./css/jquery-ui.css' />";

$extra_scripts = "<script src='./js/jquery-3.2.1.min.js'></script>
<script src='./js/bootstrap.min.js'></script>
<script src='./js/owl.carousel.min.js'></script>
<script src='./js/masonry.pkgd.min.js'></script>
<script src='./js/magnific-popup.min.js'></script>
<script src='./js/main.js'></script>
<script type='js/jquery.js'></script>
<script type='text/javascript' src='./js/jquery-3.1.1.min.js'></script>
<script type='text/javascript' src='./js/jquery.convform.js'></script>
<script type='text/javascript' src='./js/custom.js'></script>
<script type='text/javascript' src='./js/jquery-1.12.4.js'></script>
<script type='text/javascript' src='./js/jquery-ui.js'></script>
<script type='text/javascript' src='./js/bootstrap.min.js'></script>";

include_once './common/header_module.php';

// print_r($_SESSION);update
//session_start();
?>
<!DOCTYPE html>
<!-- Version SpacECE-51-->
<html lang="en">

<head>
  <title>SpaceECE</title>
  <meta charset="UTF-8" />
  <meta name="description" content="SpaceEcE" />
  <meta name="keywords" content="LERAMIZ, unica, creative, html" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link href="img/Favicon.ico" rel="shortcut icon" />

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" />

  <!-- bug id-0000115 -->
  <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
  <!-- <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- </head> -->
  <style>
    .chat_icon_container {
      position: fixed;
      bottom: 20px;
      /* Adjust as needed */
      right: 20px;
      /* Adjust as needed */
      display: inline-block;
      cursor: pointer;
      z-index: 9999;
      /* Ensure the container is on top */
    }

    .chat_icon {
      color: black;
      /* border: 2px solid black; */
      border-radius: 30px;
      padding: 10px;
      /* background-color: white; */
      /* Ensure the icon is visible */
    }

    .hover_text {
      visibility: hidden;
      width: 120px;
      background-color: #ffff0087;
      font-weight: 800;
      font-size: small;
      color: black;
      text-align: center;
      border-radius: 6px;
      padding: 10px 0;
      position: absolute;
      z-index: 10000;
      /* Bring the hover text to the front */
      bottom: 125%;
      /* Position above the icon */
      right: 100%;
      transform: translateX(-50%);
      /* Center the text */
      opacity: 0;
      transition: opacity 0.3s;
    }

    .chat_icon_container:hover .hover_text {
      visibility: visible;
      opacity: 1;
    }

    .card-hover-orange:hover * {
      color: white !important;
    }

    .card-hover-orange {
      transition: background-color 0.3s ease;
      background-color: white;
    }

    .card-hover-orange h4,
    .card-hover-orange p {
      color: black;
      transition: color 0.3s ease;
    }

    .card-hover-orange:hover {
      background-color: orange;
    }

    .card-hover-orange:hover h4,
    .card-hover-orange:hover p {
      color: white;
    }
  </style>
  <!-- Stylesheets -->
  <!-- <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

 <link rel="stylesheet" type="text/css" href="Styles.css" /> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css" />
  <link rel="stylesheet" type="text/css" href="css/responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" /> -->

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

  <!-- Header section -->
  <!-- <header class="header-section" style="background-color: orange">
    <div class="header-top" style="position: absolute; top: 15px; left: 80%">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-lg-right header-top-right">
            <div class="top-social">
              <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
              <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
              <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
              <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
            </div>
            <br /><br />

            <div class="user-panel">
              <?php
              if (isset($_SESSION['current_user_id'])) {
              ?>

                <p>Hi, <?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : "User" ?></p>

                <a href='./spacece_auth/logout.php' style="color: black">
                  <span>Logout</span>
                </a>
              <?php
              } else {
              ?>
                <a href='./spacece_auth/login.php' style="color: black">
                  <span>Login</span>
                </a>
                <a href='./spacece_auth/register.php' style="color: black">
                  <span>Register</span>
                </a>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div class="row">
        <div>
          <div>
            <div style="padding: -30px 20px">
              <i class="fa fa-bars"></i>
            </div>
            <ul class="main-menu" style="margin-left: 60px">
              <a href="index.php" style="color: black">
                <img src="img/space.jpg" alt="" style="width: 6%" />
                <h>Build-Y.Y.Y</h>
              </a>
              <li>
                <a href="index.php" style="color: black"><i class="fa fa-home"></i>HOME</a>
              </li>
              <li>
                <a href="ConsultUs/about.html" style="color: black"><i class="fa fa-users"></i> ABOUT US</a>
              </li>
              <li>
                <a href="ConsultUs/contact.html" style="color: black"><i class="fa fa-envelope" style="color: black"></i>
                  FEEDBACK</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header> -->
  <!-- Header section end -->

  <!-- Hero section -->
  <br /><br />
  <section class="hero-section set-bg" data-setbg="" style="width: 100%; height: 40%">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="./img/banner/LearnOnApp.png" alt="First slide" style="width: 100%; height: 30%" />
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./img/banner/LibForSmalls.jpeg" alt="Second slide" />
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./img/banner/SpacActive.jpeg" alt="Third slide" />
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="./img/banner/SpacTube.jpeg" alt="Fourth slide" />
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
  </section> -->




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
  <!-- Blog section -->
  <br /><br /><br /><br />
  <section class="blog-section spad" style="text-align: center;">
    <div class="container">
      <div class="section-title text-center">
        <h3 style="font-weight:bold;font-size:x-large;">OUR RECENT PROJECTS</h3>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-img-top" style="height: 150px;"><a href="./ConsultUs/index.php?cat=consult">
                <img src="img/icon_consultus.jpeg" alt="CONSULT US" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Consultus</h5>
              <p class="card-text">
                Consultus is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100 ">
            <div class="card-img-top" style="height: 150px;"> <a href="./SpacTube/view.php?cat=spacetube">
                <img src="img/icon_spacetube.jpeg" alt="SPACTUBE" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Spacetube</h5>
              <p class="card-text">
                Spacetube is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-img-top" style="height: 150px;"><a href="./learnonapp/index.php">
                <img src="img/icon_learnonapp.jpeg" alt="" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Learn On App</h5>
              <p class="card-text">
                Learn On App is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-img-top" style="height: 150px;"><a href="./libforsmall/index.php">
                <img src="img/icon_libforsmalls.jpeg" alt="" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <!-- Bug No.-> 481 (https://mantis.spacece.co.in/view.php?id=481) ---- Update the name here.  -->
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Lib For Smalls</h5>
              <p class="card-text">
                Lib For Small is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-img-top" style="height: 150px;"><a href="./spacec_active/index.php">
                <img src="img/icon_spaceactive.jpeg" alt="TOY LIBRARY" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Spacactive</h5>
              <p class="card-text">
                Spacactive is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card h-100">
            <div class="card-img-top" style="height: 150px;"> <a href="./child_profile/home.php">
                <img src="img/logo/childprofilemanagement.jpeg" alt="CHILLDRENS PROFILE" width="150" height="150" /></a>
              <h5><a href="#"> </a></h5>
            </div>
            <div class="card-body text-start card-hover-orange">
              <h5 class="card-title" style="font-weight:bold;font-size:x-large;">Child Management</h5>
              <p class="card-text">
                Child Management is a web-based tool that allows guardians to book appointments with childcare experts such as pediatricians, child psychologists, nutritionists, etc.
              </p>
            </div>
          </div>
        </div>

        <!--<span><i class="fa fa-user"></i>Parth Thosani</span>
						<span><i class="fa fa-clock-o"></i>04 Feb 2019</span>-->

        <!-- <div class="col-lg-4 col-md-6 blog-item">
          <a href="./blog/index.php">
            <img src="img/logo/children_immu_logo.jpg" alt="BABY CARE" width="300" height="300" /></a>
          <h5><a href="#"> </a></h5>
          <div class="blog-meta">
            <span><i class="fa fa-user"></i>Parth Thosani</span>
						<span><i class="fa fa-clock-o"></i>04 Feb 2019</span>
          </div>
          <p></p>
        </div> -->
        <!-- <div class="col-lg-4 col-md-6 blog-item">
          <a href="./SpacSMS/index.php">
            <img src="img/logo/preschool.png" alt="Pre School management" width="300" height="300" /></a>
          <h5><a href="#"> </a></h5>
          <div class="blog-meta">
            <span><i class="fa fa-user"></i>Parth Thosani</span>
						<span><i class="fa fa-clock-o"></i>04 Feb 2019</span>
          </div>
          <p></p>
        </div> -->

      </div>
    </div>
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
    <div class="container mt-5">
      <div class="section-title">
<<<<<<< HEAD
        <h3 style="font-weight:bold;font-size:x-large;" class="text-center">THE BENEFITS WE PROVIDE</h3>
=======
        <h3 style="font-weight:bold;font-size:x-large;" class="text-center">The Benefits we provide</h3>
>>>>>>> 2cfc2e42e4f3c0f80368a11e2458c666f724aaeb
        <p></p>
      </div>
      <div class="row g-4 ">
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-shapes fa-2x text-warning me-3"></i>
            <span class="text-start">A wide variety of offerings that help your children grow.</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-user-shield fa-2x text-warning me-3"></i>
            <span class="text-start">Privacy & availability</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-certificate fa-2x text-warning me-3"></i>
            <span class="text-start">Reliable and trustworthy</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-stethoscope fa-2x text-warning me-3"></i>
            <span class="text-start">Access to various specialists</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-couch fa-2x text-warning me-3"></i>
            <span class="text-start">Comfort & convenience</span>
          </div>
        </div>
        <div class="col-md-4">
          <div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
            <i class="fa-solid fa-piggy-bank fa-2x text-warning me-3"></i>
            <span class="text-start">Cost effective and time efficient</span>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!---benefits section close-->

  <!---offers section-->
  <section class="hero-section set-bg" data-setbg="" style="width: 100%; height: 90%">
    <div class="container">
      <div class="section-title text-center">
        <h3 style="font-weight:bold;font-size:x-large;">GET THE BEST OFFERS HERE</h3>
        <p></p>
      </div>
      <!-- <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/o1.jpg" alt="First slide" style="width: 10%; height: 10%" />
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/o2.jpg" alt="Second slide" style="width: 100%; height: 30%" />
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
  </section> -->
      <!-- 0000086,0000085 -->
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/o1.jpg" alt="First slide" style="width: 10%; height: 10%">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/o2.jpg" alt="Second slide" style="width: 100%; height: 30%">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      <br /><br />
  </section>
  <!---offers close-->

  <!-- ChatBot -->
  <div class="chat_icon_container">
    <div class="chat_icon">
      <i class="fa fa-comments" aria-hidden="true"></i>
    </div>
    <span class="hover_text">Chat with us</span>
  </div>



  <div class="chat_box">
    <div class="my-conv-form-wrapper">
      <form action="" method="GET" class="hidden">
        <select data-conv-question="Hello! How can I help you" name="category">
          <option value="WebDevelopment">Toys Booking ?</option>
          <option value="DigitalMarketing">Booking Consultants?</option>
        </select>

        <div data-conv-fork="category">
          <div data-conv-case="WebDevelopment">
            <input type="text" name="domainName" data-conv-question="Please, tell me your domain name" />
          </div>
          <div data-conv-case="DigitalMarketing" data-conv-fork="first-question2">
            <input type="text" name="companyName" data-conv-question="Please, enter your company name" />
          </div>
        </div>

        <input type="text" name="name" data-conv-question="Please, Enter your name" />

        <input type="text" data-conv-question="Hi {name}, <br> It's a pleasure to meet you." data-no-answer="true" />

        <input data-conv-question="Enter your e-mail" data-pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" type="email" name="email" required placeholder="What's your e-mail?" />

        <select data-conv-question="Please Conform">
          <option value="Yes">Conform</option>
        </select>
      </form>
    </div>
  </div>
  <br>
  <!--session close-->

  <!-- Footer section -->
  <!-- <footer class="footer-section set-bg" style="
        background-color: orange;
        border-collapse: collapse;
        border: 2px solid navy;
        opacity: 0.7;
        padding: 30px 30px;
      ">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 footer-widget">
          <img src="img/logo1.png" alt="" />

          <div class="social">
            <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
            <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
            <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
            <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 footer-widget">
          <p style="color: black">
            Still delaying your child's health concerns ?
          </p>
          <p style="color: black">Connect with India's top doctors online</p>
        </div>
        <div class="col-lg-3 col-md-6 footer-widget">
          <div class="contact-widget">
            <h5 class="fw-title text-center" style="color: black">
              CONTACT US
            </h5>
            <p style="color: black">
              <a href="http://www.spacece.in/" style="color: black">
                <i class="fa fa-map-marker"></i>
                SPACE-ECE
              </a>
            </p>
            <p style="color: black">
              <a href="tel: +919096305648" target="_blank" rel="noopener" style="color: black">
                <i class="fa fa-phone" style="color: black"></i>
                +91 90963 05648
              </a>
            </p>
            <p style="color: black">
              <a href="mailto:events@spacece.co" target="_blank" rel="noopener" style="color: black">
                <i class="fa fa-envelope" style="color: black"></i>
                contactus@spacece.co
              </a>
            </p>
            <p style="color: black">
              <i class="fa fa-clock-o" style="color: black"></i>
              Mon - Sat, 8AM - 6PM
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-widget">
          <div class="newslatter-widget">
            <h5 class="fw-title" style="color: black; text-align: center">
              NEWSLETTER
            </h5>
            <p style="color: black">
              Subscribe your email to get the latest news and new offer also
              discount
            </p>
            <form class="footer-newslatter-form">
              <input type="text" placeholder="Email address" />
              <button style="cursor: pointer" type="submit">
                <i class="fa fa-send"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px">
    <span style="font-size: 20px"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span>
  </p>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/masonry.pkgd.min.js"></script>
  <script src="js/magnific-popup.min.js"></script>
  <script src="js/main.js"></script>
  <script type="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.convform.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript" src="js/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="js/jquery-ui.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
</body> -->

  <?php
  include_once './common/footer_module.php';
  ?>
  <script type="text/javascript" src="js/jquery.convform.js"></script>

</body>

</html>