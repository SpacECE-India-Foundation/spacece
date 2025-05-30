<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';
$sub_page = true;
if (empty($_SESSION['current_user_id'])) {
	echo '<script>
    alert("User must be logged in!!");
    window.location.href = "../spacece_auth/login.php";
  </script>';
	exit;
}
?>
<!-- Check this -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Page Preloder -->
<div id="preloder">
	<div class="loader"></div>
</div>
</script>

<div class=" " data-setbg="" style=" border-radius: 1%; ">
	<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class=" " src="../img/d7.jpg" alt="First slide">
			</div>
			<div class="carousel-item">
				<img class="d-block" src="../img/d8.jpg" alt="Second slide">
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

<!-- Blog section --><br><br>
<section class="blog-section">
	<div class="container">
		<div class="section-title text-start">
			<h3>TOP SPECIALTIES</h3>
			<!-- <p>Connect with India's top doctor consultant for your child</p> -->
		</div>
		<div class="row g-5">
			<?php

			include '../Db_Connection/db_consultus_app.php';

			$check = "SELECT * FROM consultant_category ";
			$run = mysqli_query($conn, $check);

			if (mysqli_num_rows($run) > 0) {
				while ($row = mysqli_fetch_assoc($run)) {

			?>

					<div class="col-md-4 my-4">
						<div class="card h-100">
							<div class="card-img-top" style="height: 150px;"><a href="cdetails.php?category=<?php echo $row['cat_name']; ?>">
									<img src="../img/consult_category/<?php echo $row['cat_img']; ?>" alt="" width="500" height="200"></a>
								<h5><a href="#"> </a></h5>
							</div>
							<div class="card-body text-start mt-5">
								<h5 class="card-title" style="font-weight:bold;font-size:x-large; color:orange"><?= $row['cat_name']; ?></h5>
								<p class="card-text">

								</p>
							</div>
						</div>
						<!-- //bug id-0000076 -->
						<!-- <h3><?php echo $row['cat_name']; ?></h3> -->
						<!-- <a href="cdetails.php?category=<?php echo $row['cat_name']; ?>">
							<img src="../img/consult_category/<?php echo $row['cat_img']; ?>" alt="" width="500" height="200"></a>
						<h5><a href="#"> </a></h5> -->
						<div class="blog-meta">
							<!--<span><i class="fa fa-user"></i>Manas Sinkar</span>
						<span><i class="fa fa-clock-o"></i>25 Jan 2019</span>-->
						</div>
						<p> </p>
					</div>
			<?php	}
			} else {
				die();
			}
			?>
			<!-- <div class="col-lg-4 col-md-6 blog-item"> -->
			<div class="col-md-4 my-4">
				<div class="card h-100">
					<!-- //bug id-0000076 -->
					<!-- <h3>All</h3> -->
					<div class="card-img-top" style="height: 150px;">
						<a href="cdetails.php?category=all">
							<img src="../img/consult_category/all.png" alt="" width="500" height="200"></a>
						<h5><a href="#"> </a></h5>
					</div>
					<div class="card-body text-start mt-5">
						<h5 class="card-title" style="font-weight:bold;font-size:x-large; color:orange">All Categories</h5>
						<p class="card-text">

						</p>
					</div>
				</div>
				<div class="blog-meta">
					<!--<span><i class="fa fa-user"></i>Manas Sinkar</span>
			<span><i class="fa fa-clock-o"></i>25 Jan 2019</span>-->
				</div>
				<p> </p>
			</div>

		</div>
	</div>
</section>


<div class="section col" style="width: 100%; ">
	<div class="container mt-5">
		<div class="section-title text-start">
			<h3 style="font-weight:bold;font-size:x-large;">BENEFITS OF ONLINE CONSULTATION</h3>
			<p></p>
		</div>
		<div class="row g-4 ">
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-shapes fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">A wide variety of offerings that help your children grow.</span>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-user-shield fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">Privacy & availability</span>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-certificate fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">Reliable and trustworthy</span>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-stethoscope fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">Access to various specialists</span>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-couch fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">Comfort & convenience</span>
				</div>
			</div>
			<div class="col-md-4 my-4">
				<div class="d-flex align-items-center border rounded p-3 bg-white h-100" style="min-height: 100px;">
					<i class="fa-solid fa-piggy-bank fa-2x text-warning" style="margin-right: 1rem;"></i>
					<span class="text-start">Cost effective and time efficient</span>
				</div>
			</div>
		</div>
	</div>

	
		
</div>

<!-- new code -->
<div class="section col" style="width: 100%;">
	<div class="text-center">
		<div class="section-title text-center">
			<h3>GET THE BEST OFFERS HERE</h3>
			<p></p>
		</div>
		<div id="carouselOffersControls" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="../img/o1.jpg" alt="First slide" style="width: 100%; height: 10%;">
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="../img/o2.jpg" alt="Second slide" style="width: 100%; height: 30%;">
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselOffersControls" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselOffersControls" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
</div>

<br><br>


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
</div>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


<!-- <script type="js/jquery.js"></script> -->
<!-- <script type="text/javascript" src="js/jquery-3.1.1.min.js"> -->
<!-- </script> -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>

<script src='js/masonry.pkgd.min.js'></script>
<script src='js/magnific-popup.min.js'></script>
<script src='../js/jquery.convform.js'></script>
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

<div>
  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- SweetAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    .fa {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
      font-size: 20px;
      width: 40px;
      height: 40px;
      margin: 5px;
      text-align: center;
      text-decoration: none;
      border-radius: 50%;
      transition: transform 0.2s ease;
    }

    .fa:hover {
      transform: scale(1.1);
      opacity: 0.8;
    }

    .fa-facebook-f {
      background: #3B5998;
      color: white;
    }

    .fa-twitter {
      background: #55ACEE;
      color: white;
    }

    .fa-linkedin {
      background: #007bb5;
      color: white;
    }

    .fa-instagram {
      color: white;
      background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
      box-shadow: 0px 3px 10px rgba(0, 0, 0, .25);
    }

    @media only screen and (max-width: 600px) {
      .on-desktop {
        display: none;
      }

      .on-mobile {
        display: block;
      }
    }

    @media (min-width: 1025px) and (max-width: 1280px) {
      .on-desktop {
        display: block;
      }

      .on-mobile {
        display: none;
      }
    }

    .footer-widget {
      padding-left: 5px !important;
      padding-right: 5px !important;
    }

    .email-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .email-label {
      display: block;
      margin-bottom: 10px;
      font-size: 18px;
      color: #333;
    }

    .email-form {
      display: flex;
      border: 1px solid #ccc;
      border-radius: 16px;
      padding: 6px;
      background: white;
    }

    .email-form input[type="email"] {
      flex: 1;
      min-width: 100px;
      padding: 16px;
      border: none;
      outline: none;
      font-size: 16px;
    }

    .email-form button {
      padding: 12px 20px;
      background-color: #fff;
      font-weight: bold;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 12px;
      cursor: pointer;
      transition: background 0.2s ease;
    }

    .email-form button:hover {
      background-color: rgb(215, 211, 211);
    }
  </style>
  </head>

  <body>


    <footer class="bg-white border-top mb-5">
      <div class="container" style="padding-top: 30px;">

        <div class="row g-5">


          <!-- Logo Section -->
          <div class="col-md-3 mb-3 mt-5">
            <a href="http://www.spacece.in">
              <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" class="img img-fluid img-thumbnail img-circle" alt="Logo" style="width: 240px; height:240px; border:none; margin-top:-40px;" />
            </a>
          </div>

          <!-- Contact Section -->
          <div class="col-md-3 mb-3 mt-5 text-start text-start">
            <div class="contact-widget" style="color: black;">
              <h5 style="font-size: 20px;">Contact Us</h5>
              <p class="mb-3 fs-6" style="margin-right:120px; color: black;"><i class="fa-solid fa-phone text-warning me-2"></i> +91 90963 05648</p>
              <p class="mb-3 fs-6"style="margin-right:100px;color: black;"><i class="fas fa-envelope text-warning me-2"></i> events@spaceece.co</p>
              <p class="mb-3 fs-6"style="margin-right:170px;color: black;"><i class="fas fa-map-marker-alt text-warning me-2"></i> SPACE-ECE</p>
              <p class="mb-3 fs-6"style="margin-right:120px;color: black;"><i class="f as fa-clock text-warning me-2"></i> Mon - Sat 8 AM - 6 PM</p>

            </div>
          </div>

          <!-- Health Message + Social Media -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 class="text-warning" style="font-size:20px;">Still delaying treatment for your child's health concerns?</h5>
            <p class="mb-3 fs-6" style="text-align: left;color: black;">Connect with India’s top doctors online, today!</p>
            <h5 style="font-size:20px">Our Socials</h6>
              <div>
                <a href="https://www.facebook.com/SpacECEIn" target="_blank" class="text-dark me-3"><i class="fa-brands fa-facebook "></i></a>
                <a href="https://twitter.com/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-twitter "></i></a>
                <a href="https://www.linkedin.com/company/spacece-co/" target="_blank" class="text-dark me-3"><i class="fa-brands fa-linkedin "></i></a>
                <a href="https://www.instagram.com/spacece.in/" target="_blank" class="text-dark"><i class="fa-brands fa-instagram "></i></a>
              </div>

          </div>

          <!-- Newsletter Section -->
          <div class="col-md-3 mb-3 mt-5 text-start">
            <h5 style="font: size 20px;">Subscribe To Our Newsletter</h5>
            <p class="mb-3 fs-6" style="text-align: left;color: black;">Subscribe to our newsletter to get updates, offers and discounts.</p>

            <div class="email-container">
              <label class="email-label fs-6" for="email">Enter your email -</label>
              <form id="sub" class="email-form">
                <input type="email" id="email" placeholder="Email here" required />
                <button type="submit">Submit</button>
              </form>
            </div>

          </div>

        </div>
      </div>

    </footer>

    <?= isset($extra_scripts) ? $extra_scripts : null ?>

    <script>
      $(document).ready(function() {
        $('#sub').on('submit', function(e) {
          e.preventDefault();
          var email = $('#email').val();

          $.ajax({
            method: "POST",
            url: "./common/function.php",
            data: {
              subscribe: 1,
              email: email
            },
            success: function(data) {
              console.log("Server response:", data);
              handleSubscriptionResponse(data);
            },
            error: function(xhr, status, error) {
              swal("Error!", "Something went wrong. Please try again later.", "error");
            }
          });
        });

        function handleSubscriptionResponse(data) {
          switch (data.trim()) {
            case 'Error':
              swal("Error!", "You have already subscribed to this site!", "error");
              break;
            case 'Success':
              swal("Good job!", "You have subscribed!", "success");
              break;
            case 'Invalid':
              swal("Error!", "Please enter a valid email!", "error");
              break;
            default:
              swal("Error!", "Unexpected response from the server.", "error");
          }
        }
      });
    </script>

  </body>

  </html>
</div>	
