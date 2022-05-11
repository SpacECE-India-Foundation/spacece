<!--Header: site header with title, description & meta content-->
<?php include 'inc/header.php'; ?>
<?php include './header_local.php'; ?>
<?php include '../common/header_module.php'; ?>
<?php
//session_start();
if(isset($_SESSION['current_user_type'])){
	if($_SESSION['current_user_type']=='admin'){

    	header("Location:admin.php?id=index");	
		exit();
	 }
}
   

?>


<!--MENU: navigation bar-->
<?php //include 'inc/menu.php'; ?>

<!--//Note: Wellcome note of this website//--> 
<?php include 'inc/welcomesection.php'; ?>
		
<!--//Content: Content of this website //-->
<?php include 'inc/contentsection.php'; ?>

<!--//Footer: footer navigation & social link -->
<?php include "../common/footer_module.php" ?>