<?php
//session_start();
error_reporting(0);
include('include/config.php');
include '../../../common/header_module.php';
if(empty($_SESSION['current_user_email'])){
	header('location:../../../spacece_auth/login.php');
	exit();
}
//include('include/checklogin.php');
//check_login();

if(isset($_POST['submit']))
{	
	$eid=$_GET['editid'];
	$childname=$_POST['childname'];
$parentcontact=$_POST['parentcontact'];
$parentemail=$_POST['parentemail'];
$gender=$_POST['gender'];
$parentaddress=$_POST['parentaddress'];
$childage=$_POST['childage'];
$medhis=$_POST['medhis'];
$sql=mysqli_query($con,"update tblchildren set childName='$childname',parentContno='$parentcontact',parentEmail='$parentemail',childGender='$gender',parentAdd='$parentaddress',childAge='$childage',childImmu='$medhis' where ID='$eid'");
if($sql)
{
echo "<script>alert('Child info updated Successfully');</script>";
header('location:manage-child.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Register Child</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


	</head>
	<body style="background-image:url('b1.jpg'); background-repeat: no-repeat; background-size: cover; background-filter: blur(8px); background-position: center;
  " class="hold-transition login-page">
				
				<div class="mt-3" style="margin-top:5%;">
	<?php include('include/sidenav.html');?>
	</div>

<?php //include('include/head.php');?>
						

						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 style="padding-left: 600px;color: red;"class="mainTitle">Doctor | Edit Child Info</h1>
</div>

</div>
</section>
<div style="padding-left: 500px;" class="container-fluid container-fullw bg-skybue">
<div class="row">
<div class="col-md-12">
<div class="row margin-top-30">
<div class="col-lg-8 col-md-12">
<div class="panel panel-white">
<div class="panel-heading">
<h5 class="panel-title">Add Child</h5>
</div>
<div class="panel-body">
<form role="form" name="" method="post">
<?php
 $eid=$_GET['editid'];
$ret=mysqli_query($con,"select * from tblchildren where ID='$eid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<div class="form-group">
<label for="doctorname">
Child Name
</label>
<input type="text" name="childname" class="form-control"  value="<?php  echo $row['childName'];?>" required="true">
</div>
<div class="form-group">
<label for="fess">
 Parent Contact no
</label>
<input type="text" name="parentcontact" class="form-control"  value="<?php  echo $row['parentContno'];?>" required="true" maxlength="10" pattern="[0-9]+">
</div>
<div class="form-group">
<label for="fess">
Parent Email
</label>
<input type="email" id="parentemail" name="parentemail" class="form-control"  value="<?php  echo $row['parentEmail'];?>" readonly='true'>
<span id="email-availability-status"></span>
</div>
<div class="form-group">
              <label class="control-label">Child Gender: </label>
              <?php  if($row['Gender']=="Female"){ ?>
              <input type="radio" name="gender" id="gender" value="Female" checked="true">Female
              <input type="radio" name="gender" id="gender" value="male">Male
              <?php } else { ?>
              <label>
              <input type="radio" name="gender" id="gender" value="Male" checked="true">Male
              <input type="radio" name="gender" id="gender" value="Female">Female
              </label>
             <?php } ?>
            </div>
<div class="form-group">
<label for="address">
Client Address
</label>
<textarea name="parentaddress" class="form-control" required="true"><?php  echo $row['parentAdd'];?></textarea>
</div>
<div class="form-group">
<label for="fess">
 Child Age
</label>
<input type="text" name="childage" class="form-control"  value="<?php  echo $row['childAge'];?>" required="true">
</div>
<div class="form-group">
<label for="fess">
 Disease being sought immunization for
</label>
<textarea type="text" name="medhis" class="form-control"  placeholder="Enter name of the disease to be vaccinated for" required="true"><?php  echo $row['childImmu'];?></textarea>
</div>	
<div class="form-group">
<label for="fess">
 Creation Date
</label>
<input type="text" class="form-control"  value="<?php  echo $row['CreationDate'];?>" readonly='true'>
</div>
<?php } ?>
<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
Update Child Info
</button>
</form>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-12 col-md-12">
<div class="panel panel-white">
</div>
</div>
</div>
</div>
</div>
</div>				
</div>
</div>
</div>
			<!-- start: FOOTER -->
<?php include('../../../common/footer_module.php');?>
			<!-- end: FOOTER -->
		
			
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
