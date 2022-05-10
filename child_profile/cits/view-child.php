<?php
//session_start();
include '../../common/header_module.php';
error_reporting(0);
include('include/config.php');
//include('include/checklogin.php');
//c//heck_login();
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $br=$_POST['br'];
    $bh=$_POST['bh'];
    $weight=$_POST['weight'];
    $temp=$_POST['temp'];
   $pres=$_POST['pres'];
   
 
      $query.=mysqli_query($con, "insert   tblimmunization(childID,vaccineID,vaccineName,adminmethod,bodysite,nextdate)value('$vid','$br','$bh','$weight','$temp','$pres')");
    if ($query) {
    echo '<script>alert("Immunization details have been added.")</script>';
    echo "<script>window.location.href ='manage-child.php'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Parent | View Child Info</title>
		
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
				
<?php include('include/sidenav.html');?>

<?php include('include/head.php');?>
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 style="color: red; padding-left: 400px" class="mainTitle">User | View Child immunization Details</h1>
</div>

</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Child</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from tblchildren where ID='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Child Details</td></tr>

    <tr>
    <th scope>Child Name</th>
    <td><?php  echo $row['childName'];?></td>
    <th scope>Parent Email</th>
    <td><?php  echo $row['parentEmail'];?></td>
  </tr>
  <tr>
    <th scope>Parent Mobile Number</th>
    <td><?php  echo $row['parentContno'];?></td>
    <th>Parent Address</th>
    <td><?php  echo $row['parentAdd'];?></td>
  </tr>
    <tr>
    <th>Child Gender</th>
    <td><?php  echo $row['childGender'];?></td>
    <th>Child Age</th>
    <td><?php  echo $row['childAge'];?></td>
  </tr>
  <tr>
    
    <th>Disease to be vaccinated against</th>
    <td><?php  echo $row['childImmu'];?></td>
     <th>Cattle Reg Date</th>
    <td><?php  echo $row['CreationDate'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  

$ret=mysqli_query($con,"select * from tblimmunization  where childID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="8" >Immunization History</th> 
  </tr>
  <tr>
    <th>#</th>
<th>Vaccine Id</th>
<th>Vaccine Name</th>
<th>Administration Method</th>
<th>Body-Site</th>
<th>Next date of Vaccination</th>
<th>Immunization Date</th>
</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
 <td><?php  echo $row['vaccineID'];?></td>
 <td><?php  echo $row['vaccineName'];?></td>
 <td><?php  echo $row['adminmethod'];?></td> 
  <td><?php  echo $row['bodysite'];?></td>
  <td><?php  echo $row['nextdate'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Immunizationt Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

      <tr>
    <th>Vaccine ID :</th>
    <td>
    <input name="br" placeholder="Vccine ID" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Vaccine Name :</th>
    <td>
    <input name="bh" placeholder="name of vaccine administered" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Administration Method :</th>
    <td>
    <input name="weight" placeholder="method of administering vaccine" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Body-site :</th>
    <td>
    <input name="temp" placeholder="Body where administered" class="form-control wd-450" required="true"></td>
  </tr>
                         
     <tr>
    <th>Next date of Immunization :</th>
    <td>
    <textarea name="pres" placeholder="Next date of Immunization" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>  
   
</table>
</div>
<div class="modal-footer">
 <button style="background-color: red; color: white" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button style="background-color: green" type="submit" name="submit" class="btn btn-primary">Submit</button>
  
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php include('../../common/footer_module.php');?>
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
