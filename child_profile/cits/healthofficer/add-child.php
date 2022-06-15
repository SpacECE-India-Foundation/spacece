<?php
//session_start();
include './header_local.php';
error_reporting(0);
include('include/config.php');
// include('include/checklogin.php');
// check_login();

if(isset($_POST['submit']))
{	
	$docid=$_SESSION['current_user_id'];
	$childname=$_POST['childname'];
$parentcontact=$_POST['parentcontact'];
$parentemail=$_POST['parentemail'];
$gender=$_POST['gender'];
$parentaddress=$_POST['parentaddress'];
$childage=$_POST['childage'];
$medhis=$_POST['medhis'];
$dob=$_POST['childob'];
var_dump($_POST);
echo $dob;
$sql=mysqli_query($con,"insert into tblchildren(Docid,childName,parentContno,parentEmail,childGender,parentAdd,childAge,childImmu,childDoB) values('$docid','$childname','$parentcontact','$parentemail','$gender','$parentaddress','$childage','$medhis','$dob')");
if($sql)
{
echo "<script>alert('Patient info added Successfully');</script>";
header('location:add-child.php');

}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Register  Child</title>
		
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

	<script>
function userAvailability() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'email='+$("#parentemail").val(),
type: "POST",
success:function(data){
$("#user-availability-status1").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
	</head>
	<body style="background-image:url('b1.jpg'); background-repeat: no-repeat; background-size: cover; background-filter: blur(8px); background-position: center;
  " class="hold-transition login-page">
	<?php include('../../../common/header_module.php');
	if(empty($_SESSION['current_user_email'])){
		header('location:../../../spacece_auth/login.php');
		exit();
	}?>

<section id="page-title">
<div class="nav" style="margin-top: 5%;">
	<?php include('include/sidenav.html');?>
	</div>
<div class="row">

<div class="col-sm-8">
<h1 style="color: red; padding-left: 570px" class="mainTitle">Doctor | Register Child</h1>
</div>

</div>
</section>
<div style="padding-left: 500px;" class="container-fluid container-fullw bg-skyblue">
<div class="row">
<div class="col-md-12">
<div class="row margin-top-30">
<div class="col-lg-8 col-md-12">
<div class="panel panel-white">
<div class="panel-heading">
<h5 class="panel-title">Register Child</h5>
</div>
<div class="panel-body">
<form role="form" name="" method="post">

<div class="form-group">
<label for="doctorname">
Child Name
</label>
<input type="text" name="childname" class="form-control"  placeholder="Enter the name of the Child" required="true">
</div>
<div class="form-group">
<label for="fess">
 Parent Contact no
</label>
<input type="text" name="parentcontact" class="form-control"  placeholder="Enter Parent Contact No." required="true" maxlength="10" pattern="[0-9]+">
</div>
<div class="form-group">
<label for="fess">
Parent Email
</label>
<input type="email" id="parentemail" name="parentemail" class="form-control"  placeholder="Enter Parent Email id here" required="true" onBlur="userAvailability()">
<span id="user-availability-status1" style="font-size:12px;"></span>
</div>
<div class="form-group">
<label class="block">
Child Gender
</label>
<div class="clip-radio radio-primary">
<input type="radio" id="rg-female" name="gender" value="female" >
<label for="rg-female">
Female
</label>
<input type="radio" id="rg-male" name="gender" value="male">
<label for="rg-male">
Male
</label>
</div>
</div>
<div class="form-group">
<label for="address">
Parent Address/Residence
</label>
<textarea name="parentaddress" class="form-control"  placeholder="Enter parent address and area of residence" required="true"></textarea>
</div>
<div class="form-group">
<label for="fess">
 Child Age
</label>
<input type="text" name="childage" class="form-control"  placeholder="Enter the age of the child " required="true">
</div>
<div class="form-group">
<label for="fess">
 Date of birth
</label>
<input type="date" name="childob" id="childob" class="form-control"  placeholder="Select dob" required="true">
</div>
<div class="form-group">
<label for="fess">
Disease being sought immunization for
</label>
<textarea type="text" name="medhis" class="form-control"  placeholder="Enter name of the disease to be vaccinated for" required="true"></textarea>
</div>	

<button type="submit" name="submit" id="submit" class="btn btn-o btn-primary">
Register
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
		
			<!-- start: SETTINGS -->
<?php //include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
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
