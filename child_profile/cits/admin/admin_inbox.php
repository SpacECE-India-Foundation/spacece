<?php
//session_start();
include '../../../common/header_module.php';
if(empty($_SESSION['admin_id'])){
	header('location:../../../spacece_auth/login.php');
	exit();
}
include("include/config.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Queries</title>
	
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
		
		
			
				
						<?php // include('include/head.php');?><br><br>
					
				<!-- end: TOP NAVBAR -->
<div style="padding-left:250px" class="container"  style='margin-top:70px;'>
<div class="container " style="margin-top:2% ;">
		<div class="nav">
		<?php include('include/sidenav.html');?>
		</div>
	
	</div>
	<div class="row">
				<div class="col-sm-9" >
			<h3 class="text-primary"><i class="fa fa-envelope"></i> Inbox </h3><hr>    
			
<?php 
$sql="SELECT * FROM messages ORDER BY ID DESC";
$result=$con->query($sql);
if($result->num_rows>0)
{
	echo '<ul class="list-group">';
		while($row=$result->fetch_assoc())
		{
			if($row['STATUS']=='1')
			{
				echo '<li class="list-group-item active">
						<span>
							<b><i class="fa fa-envelope-square"> </i>      	'.$row["NAME"].'</b>: '.substr($row["MESSAGE"],0,50).'....
						</span>
						<span   class="pull-right">
							<i>'.$row['LOGS'].'</i>&nbsp;
							<a href="messview.php?id='.$row['ID'].'" class="btn btn-primary  btn-xs">View</a>
							<a href="admin_mess_del.php?id='.$row['ID'].'"  class="btn btn-danger btn-xs">Delete</a>
						</span>

					</li>';
			}
			else
			{
				echo '<li class="list-group-item">
						<span>
							<b><i class="fa fa-envelope-square
"></i> '.$row["NAME"].'</b>: '.substr($row["MESSAGE"],0,50).'....
						</span>
						<span   class="pull-right">
							<i>'.$row['LOGS'].'</i>&nbsp;
							<a href="messview.php?id='.$row['ID'].'" class="btn btn-primary btn-xs">View</a>
							<a href="admin_mess_del.php?id='.$row['ID'].'"  class="btn btn-danger btn-xs">Delete</a>
						</span>
				</li>';
			}
			echo"<br>";
		}
	echo'</ul>';
}
else
{
	echo "<div class='alert alert-info mess'>No More Messages</div>";
}

					
					
					
					
					
					
					?>
		
		</div>
	</div>
</div>
                <!-- start: FOOTER -->
	<?php include('../../../common/footer_module.php');?>
			<!-- end: FOOTER -->
		
			
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