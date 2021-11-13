<?php include('indexDB.php'); ?>
<?php error_reporting(0); 
$ref = $_GET['user']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SPAC-ECE</title>
	<meta charset="UTF-8">
	<meta name="description" content="SPAC-ECE">
	<meta name="keywords" content="LERAMIZ, unica, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=10.0">
	<!-- Favicon -->   
	<link href="img/Favicon.ico" rel="shortcut icon"/>

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
	<link rel="stylesheet" type="text/css" href="css/jquery.convform.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
     
	


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body>	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	
	<!-- Header section -->
	<header class="header-section">
		<div class="header-top" style = "position:absolute; left:60%; top:15px;">
			<div class="container">
				<div class="row">
					
					<div class="col-lg-12 text-lg-right header-top-right">
						<div class="top-social">
							
							<a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook"></i></a>
							<a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram"></i></a>
							<a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram" aria-hidden="true"></i></a>
							<a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin"></i></a>
							<br>
						</div>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
 						&nbsp&nbsp&nbsp&nbsp&nbsp	&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

						<div class="main-menu" style="background-color:orange;opacity:0.7;padding:5px;">  
						 						<a href="myinfo.php?user=<?php echo $ref ?>"> 
                                      <img align="top-right" src="https://doctoryouneed.org/wp-content/uploads/2020/05/dr-new-demo-image-57.png" alt="ALL DOCTOR DETAILS" width="100" height="100">
                                    &nbsp&nbsp&nbsp<button><div class="bottom" style="color: black;" style="font-weight:200;"><b> MY INFO </b></div></a></button>
					<h5><a href="#">  </a></h5>
					<center><button style="background-color:blak;"><a href="index.html" style="color:black;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>&nbspLOGOUT&nbsp</b> </a></button></center>
							
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
							<li><a href="index.html" style="color:black;"><i class="fa fa-home"></i> HOME</a></li>
							<li><a href="about.html" style="color:black;"><i class="fa fa-users"></i> ABOUT US</a></li>
							<li><a href="contact.php" style="color:black;"><i class="fa fa-envelope" style="color:black;"></i> FEEDBACK</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->



    


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="" style="width: 100%; height: 90%; ">
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" >
      <img class="d-block w-100" src="img/d7.jpg" alt="First slide" style="width: 100%; height: 30%;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/d8.jpg" alt="Second slide">
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

		</section>
		<br><br><br>

	<section class="blog-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>TOP SPECIALTIES</h3>
				<p>Connect with India's top doctor consultant for your child</p>
			</div>
				<div class="col-lg-4 col-md-6 blog-item">
                <a href="appoint_consultant.php?user=<?php echo $ref ?>"> 
                                        <img align= "centered" src="https://doctoryouneed.org/wp-content/uploads/2020/05/dr-new-demo-image-57.png" alt="ALL DOCTOR DETAILS" width="150" height="150">
                                    <div class="bottom" style="color: black;" style="font-weight:200;"> BOOK APPOINTMENT </div></a>
					<h5><a href="#">  </a></h5>
					<div class="blog-meta">
						<!--<span><i class="fa fa-user"></i>Parth Thosani</span>
						<span><i class="fa fa-clock-o"></i>04 Feb 2019</span>-->
					</div>
					<p>  </p>
				</div>
	<!-- Blog section end -->
	<?php $nid=$_GET['user'];
 ?>

	<html>
    <head>
        <title>Appointment-HOME PAGE</title>
        <link rel="stylesheet"  href="css/admin.css">
    </head>
    <body>
    	<div id="call"></div>
        <! ... menu section starts...>
        <div class="menu text-center">
        </div>
                  <h1 style="text-align: center;"><b> MY APPOINTMENTS </b></h1><br><br>
                <table class="tb-full">
                    <tr>
                        <th>S.NO.</th>
                        <th>CID:</th>
                        <th>CATEGORY:</th>
                        <th>USERNAME:</th>
                        <th>CONSULTANT NAME</th>
                        <th>A_DATE:</th>
                        <th>A_TIME:</th>
                        <th>STATUS:</th>
                        <th>EMAIL:</th>
                        <th>MOBILE NUMBER:</th>
                        <th>UID:</th>
                        <th>ACTION:</th>
                         <th>Attend Call:</th>
                    </tr>
                    <?php
                    error_reporting(0);
                    // showing admin added from database
                    $sql = "SELECT * FROM `appointment` where `cname`='$nid'";
                    $res = mysqli_query($conn,$sql);


                    //checking whether query is excuted or not
                    if($res){
                        // count that data is there or not in database
                        $count= mysqli_num_rows($res);
                        $sno =1;
                        if($count>0){
                            // we have data in database
                            while($row = mysqli_fetch_assoc($res))
                            {
                                // extracting values from dATABASE

                                $id=$row['cid'];
                                $full_name=$row['username'];
                                $category=$row['category'];
                                $cname=$row['cname'];
                                $date_appointment=$row['date_appointment'];
                                $time_appointment=$row['time_appointment'];
                                $email=$row['email'];
                                $mobile=$row['mobile'];
                                $uid=$row['bid'];
                                $status = $row['status'];
                                $call = $row['call_url'];

                                
                                // displaying value in table
                        ?>
                        <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $category; ?></td>
                        <td><?php echo $full_name; ?></td>
                        <td><?php echo $cname; ?></td>
                        <td><?php echo $date_appointment; ?></td>
                        <td><?php echo $time_appointment; ?></td>
                        <td><?php echo $status; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $uid; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>chatbot/room.php?roomname=bid<?php echo $uid;?>" class="btn-primary">CHAT</a>
                        </td>
                        <td>
                        	<?php if($call===null){
                        		?>
                        		<a href="#" class="btn-primary">Call Not Available</a>
                       <?php }else{
                           ?> <a href="<?php echo $call;?>" class="btn-primary">Attend Call</a>
                     <?php  }
                     ?>


                        </td>

                    </tr>

                    <?php
                    }
                }
                        else{
                            echo "sorry no appointment found";
                        }
                    }
                    ?>

                </table>     
            </div>
        </div>
        <!... main section ends....>
        <! ... end section starts...>
         <div class="footer text-centre">
            <div class="wrapper">
                 <p class="text-center">DEVELOPED BY:<a href="#">yashasvi pundeer</a></p>
            </div>
         </div>
        <!... end section ends....>
    </body>


</html>
	<section class="blog-section spad">
		<div class="container">
			<div class="section-title text-center">
				<h3>BENEFITS OF ONLINE CONSULTATION</h3>
				<p></p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 blog-item" >
					
					<p><i class="fa fa-check-circle" style="color:black;"></i>Get a second opinion</p>
				</div>
				<br><br>

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
	</section>

<!---benefits section close-->


<!---offers section-->
	<section class="hero-section set-bg" data-setbg="" style="width: 100%; height: 90%; ">
		<div class="container">
			<div class="section-title text-center">
				<h3>GET THE BEST OFFERS HERE</h3>
				<p></p>
			</div>
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" >
      <img class="d-block w-100" src="img/o1.jpg" alt="First slide" style="width: 10%; height: 10%;">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="img/o2.jpg" alt="Second slide" style="width: 100%; height: 30%;">
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
		</section>
		<br><br>


<!---offers close-->














<!-- ChatBot -->
<div class="chat_icon">
	<i class="fa fa-comments" aria-hidden="true" style="color:orange;"></i>
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



<!--session close-->














	<!-- Footer section -->
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
     
     </footer>
     <p class="font_10" style="line-height: 1.8em; text-align: center; font-size: 20px;"><span style="font-size:20px;"><span class="color_15">&copy;2021 by SpacECE INDIA FOUNDATION</span></span></p>                                    
	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/masonry.pkgd.min.js"></script>
	<script src="js/magnific-popup.min.js"></script>
	<script src="js/main.js"></script>
	<script type="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js">
	</script>
<script type="text/javascript" src="js/jquery.convform.js">
		
</script>
<script type="text/javascript" src="js/custom.js">

</script>
<script type="text/javascript" src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript"src="js/bootstrap.min.js"></script>
<script type="text/javascript">

	$(document).ready(function(){


 setInterval(function(){ 
 	let user ="<?php echo $_GET['user'];?>";
//alert(user);
 //$('#call').replaceWith("");
$.ajax({
url:'./video.php',
type: 'POST',
data:{
	user:user,
	getCall:1
},
success:function(data){
       // console.log(data);
        //alert(data);
        $('#call').html(data);
    }
});

 }, 5800);

})

</script>
</body>
</html>