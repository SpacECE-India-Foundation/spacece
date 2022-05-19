<!--Header: site header with title, description & meta content-->
<?php  include './header_local.php'; ?>
<?php  include '../common/header_module.php'; ?>
<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>
<link rel="stylesheet" href="assets/css/animate.css">
<?php 
     $db = new Database();
     $fm = new Format();
?>
<!--MENU: navigation bar-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/animate.css">


   
<?php //include 'inc/menu.php'; ?>
<style>
	.sidebar{
		padding: 0 !important;
		background-color: orange;
		max-width: 20%;
		
		
	}
	.sidebar  a{
		border: none;
		color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  
  cursor: pointer;
	
	}
	.sidebar  a:hover{
	background-color: grey;
	
	}
	.sidebar ul{
		list-style: none;
	
	}
	.adminrightsection{
		/* top: -550px;
		margin-left: 30%;
		
		position:relative; */
	
	}

</style>
 <!--//Content Field for admin -->
<?php 
	// if(!isset($_GET['id'])){
	// 	header('Location:index.php?action=logout'); 
	// }

	if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
		$pageid = $_GET['id'];
		if($pageid == 'index'){
			include 'admin/index.php';

		}elseif($pageid == 'theme'){
			include 'admin/theme.php';

		}elseif($pageid == 'inbox'){
			include 'admin/inbox.php';

		}elseif($pageid == 'users'){
			include 'admin/users.php';

		}elseif($pageid == 'profile'){
		 	include 'admin/profile.php';

		}elseif($pageid == 'pagerole'){
			include 'admin/pagerole.php';

		}elseif($pageid == 'siteoptions'){
			include 'admin/siteoptions.php';

		}elseif($pageid == 'menus'){
			include 'admin/menus.php';

		}elseif($pageid == 'posts'){
			include 'admin/posts.php';
			
		}
	}else{
		header('Location:index.php?action=logout');
	}

?>

<!-- //Footer: footer navigation & social link -->
<?php //include 'admin/footeradmin.php'; ?>
<script src="assets/js/jquery.js"></script>
    <script src="assets/js/hover.zoom.js"></script>
    <script src="assets/js/hover.zoom.conf.js"></script>
    <script src="assets/js/wow.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script> 
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<?php include '../common/footer_module.php'; ?>