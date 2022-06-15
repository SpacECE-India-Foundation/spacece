<?php
include './header_local.php';
include '../../common/header_module.php';
session_start();
//error_reporting(0);
include('include/config.php');
//include('include/checklogin.php');
//check_login();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Parent  | Dashboard</title>
		
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
		<link rel="stylesheet" href="assets/css/stylesd.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


	</head>
	<body style="background-image:url('b1.jpg'); background-repeat: no-repeat; background-size: cover; background-filter: blur(8px); background-position: center;
  " class="hold-transition login-page">
				
				
			<div class="app-content">
				
						<?php  //include('include/head.php');?>
						
				<!-- end: TOP NAVBAR -->
				
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 style="color: red; padding-left: 570px"class="mainTitle">User | Dashboard</h1>
																	</div>
                                </div>
						</section>
                        <!-- Breadcrumbs-->
						<?php include('include/sidenav.html');?>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
							<div class="container-fluid container-fullw bg-skyblue">
							<div class="row">
								<div class="col-sm-4">
									<div class="panel panel-orange no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
											<h2 style="color: white;" class="StepTitle">My Profile</h2>
											
											<p class="links cl-effect-1">
												<a style="color: white;" href="edit-profile.php">
													Update Profile
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-green no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
											<h2 style="color: white;" class="StepTitle">My Appointments</h2>
										
											<p class="cl-effect-1">
												<a style="color: white;" href="appointment-history.php">
													View Appointment History
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-yellow no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-edit fa-stack-1x fa-inverse"></i> </span>
											<h2 style="color: white;" class="StepTitle"> Book My Appointment</h2>
											
											<p class="links cl-effect-1">
												<a style="color: white;" href="book-appointment.php">
													Book Appointment
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
			
					
					<?php
					var_dump($_SESSION);
					$uid=$_SESSION['current_user_id'];
					$email=$_SESSION['current_user_email'];
					$sql1="SELECT tblchildren.ID as children_id, tblchildren.childDoB,DATEDIFF(CURDATE(),tblchildren.childDoB) as diff from tblchildren  where parentEmail='$email'";
					

					$select1=mysqli_query($con,$sql1);
if($select1){

    while($row1=mysqli_fetch_assoc($select1)){
		var_dump($row1);
		$months=$row1['diff'];
        $days =0;
        if($months<2){
            $days =2;
        }elseif( $months < 6){
            $days =6;
        }elseif( $months<18){
            $days =18;   
        }elseif( $months<48){
            $days =48;  
        }
		$children_id=$row1['children_id'];
		$sql2="SELECT age  FROM `parents_answers` WHERE child_id='$children_id' ORDER by age LIMIT 1" ;
		$select2=mysqli_query($con,$sql2);
		$answer_age=0;
		while($row2=mysqli_fetch_assoc($select2)){
$answer_age=$row2['age'];
		}
      
		if($days==$answer_age){
		
			
		}else{
			$sql="SELECT * FROM `parents_questions` WHERE child_age='$days' ORDER BY q_id LIMIT 10";
			$select=mysqli_query($con,$sql);
			if($select){
				while($row=mysqli_fetch_assoc($select)){
				   
					?>
					<div class="container">
					<div class="mt-3 " style="margin-top:15%;">
				<?php include('include/sidenav.html');?>
				</div>
				
				<h4 style="display:flex;justify-content: center;">Fill The details</h4>
					<form id="answer" id="answer" method="POST" >
				
						<div class="card" style="display:flex;justify-content: center;">
						
						<h5><b><?php  echo $row['q_text']; ?></b></h5>
						<input type="hidden" id="email" name="email" value="<?php echo $_SESSION['current_user_id'];  ?>">
						<input type="hidden" id="children_id" name="children_id" value=<?php echo $row1['children_id'];  ?>/>
						<input type="hidden" id="children_age" name="children_age" value=<?php echo $days; ?>/>
						<input type="hidden" id="parent_id" name="parent_id" value=<?php echo $uid; ?>/>
					<input type="hidden" id="q_id[]" name="q_id[]" value=<?php echo $row['q_id'];  ?>/>
					<div class="form-group col-sm-3">
						<div class="col">
					<input type="text" class="form-group" id="answ[]"name="answ[]">
					</div>
					<div class="col">
					<input type="submit"  class="btn brn-sm btn-secondary" value="submit" id="submit">
					</div>
					</div>
					</div>
					</form>
					</div>
					<?php
					}
				 }
echo "else";
    }
}
}else{
    echo "No Data Found";
}
?>
						
						
					
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
	<?php include('../../common/footer_module.php');?>
			<!-- end: FOOTER -->
		
			
	

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
		<script type="text/javascript">
    $('#answer').on('submit',function(){
  

     var form=$("#answer");
     $.ajax({
        type:"POST",
        url:"./answer_ajax.php",
        data:form.serialize(),
        success:function(response){
        alert(response);
        }
    });
})
</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
