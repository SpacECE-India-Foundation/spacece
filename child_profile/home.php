<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Child Immunization Tracking System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="home/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="home/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="home/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="home/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="home/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="home/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="js/use.js"></script>
</head>
<body style="background-image:url('b1.jpg'); background-repeat: no-repeat; background-size: cover; background-filter: blur(8px); background-position: center;
  " class="hold-transition login-page">
    <div style="padding-left: 100px;padding-right: 100px" class="topnav">
  <a style="float: left; font-size: 15pt;color: black;" class="active" href="home.php"><i class="fa fa-child"></i> Child Immunization Tracking System</a>
  <a style="font-size: 15pt;color: black;" href="cits/admin/index.php"><i class="fa fa-sign-in"></i> Admin</a>
  <a style="font-size: 15pt;color: black;" href="cits/healthofficer/index.php"><i class="fa fa-sign-in"></i> Doctor</a>
  <a style="font-size: 15pt;color: black;" href="cits/user-login.php"><i class="fa fa-sign-in"></i> Parent</a>
  <a style="font-size: 15pt;color: black;" href="about.php"><i class="fa fa-info"></i> About Us</a>
  <a style="font-size: 15pt;color: black;" href="contact.php"><i class="fa fa-envelope"></i> Contact Us</a>
  <a style="font-size: 15pt;color: black;" href="home.php"><i class="fa fa-home"></i> Home</a>
</div>
        <marquee direction="up" style="background-color: BLACK;color: lightgreen; height: 20px;text-align: center;" scrollamount="1" onmouseover="this.stop();" onmouseover="this.start();">
<b><i>CHILD IMMUNIZATION TRACKING  SYSTEM<br>SECURE AND ACCURATE IMMUNIZATION INFORMATION MANAGEMENT!<br>using computerized databases that record all immunization doses administered  to children.</i></b><br>WEAR A MASK!STAY SAFE!!
</marquee>
<style>
/* Add a black background color to the top navigation */
.topnav {
  background-color: #87ceeb;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: right;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #4ac;
  color: white;
}

/* Add a color to the active/current link */
.topnav a.active {
  color: white;
}
</style>
		<div class="clear"> </div>
<div class="container">
        <div class="services-bar">
            <h1 class="my-4"><b>Our Best Services </b></h1>
            <!-- Services Section -->
            <div class="row">
               <div class="col-lg-4 mb-4">
                  <div class="card h-100">
                     <h4 class="card-header">You can now book an appointment</h4>
                     <div class="card-img">
                        <img class="img-fluid" src="S1.jpg" alt="" />
                     </div>
                     <div class="card-body">
                        <p style="color: black" class="card-text"><b>Book for an immunization appointment with the health personnel in just one click.</b></p>
                     </div><br>
                     <div class="card-footer">
                        <a href="cits/user-login.php" class="btn btn-primary">Sign in as user</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 mb-4">
                  <div class="card h-100">
                     <h4 class="card-header">All immunization records in one place</h4>
                     <div class="card-img">
                        <img class="img-fluid" src="S2.jpg" alt="" />
                     </div>
                     <div class="card-body">
                        <p style="color: black" class="card-text"><b>All the strain on manual records now at bay.</b></p><br>
                     </div><br>
                     <div class="card-footer">
                        <a href="cits/healthofficer/index.php" class="btn btn-primary">Health Personnel Log in</a>
                     </div>
                  </div>
               </div>
               
               <div style="padding-left: 100px" class="col-lg-4 mb-4">
                  <div class="card h-100">
                     <h4 class="card-header">Manage all records in one store</h4>
                     <div class="card-img">
                        <img class="img-fluid" src="S3.jpg" alt="" />
                     </div>
                     <div class="card-body">
                        <p style="color: black" class="card-text"><b>Easy and faster access to records for management.</b></p>
                      </div> 
                      <div class="card-footer">
                        <a href="cits/admin/index.php" class="btn btn-primary">Admin Log in</a>
                     </div> </div> </div></div><br>
                    <div class="clear"> </div><br><br><br><br> <br><br>  

<!-- jQuery 3 -->
<script src="home/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="home/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="home/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
                      
    <div  style="text-align: center;  color: black; font-size: 13pt; padding-left: -100px;" class="copyright">
						&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> 2021 CITS</span>. <span>All rights reserved</span>
					</div>
</body>
</html>
