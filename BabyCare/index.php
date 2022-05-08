<!--Header: site header with title, description & meta content-->

<?php
session_start();
if(!isset($_SESSION['current_user_id'])){
header('Location:../spacece_auth/login.php');

}else{
    if($_SESSION['current_user_type']=='admin'){

    	header("Location:admin.php?id=index");	
	 }
}
?>

<?php include 'inc/header.php'; ?>

<!--MENU: navigation bar-->
<?php include 'inc/menu.php'; ?>

<!--//Note: Wellcome note of this website//--> 
<?php include 'inc/welcomesection.php'; ?>
		
<!--//Content: Content of this website //-->
<?php include 'inc/contentsection.php'; ?>

<!--//Footer: footer navigation & social link -->
<?php include 'inc/footer.php'; ?>