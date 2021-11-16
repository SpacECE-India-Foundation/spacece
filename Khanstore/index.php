<?php
//require "config/constants.php";
//session_start();
include_once 'includes/header1.php';

if (isset($_SESSION["uid"])) {
	header("location:profile.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Khan Store</title>
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css" /> -->
	<script src="js/jquery2.js"></script>
	<!-- <script src="js/bootstrap.min.js"></script> -->
	<script src="main.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style></style>
</head>

<body>
	<div class="wait overlay">
		<div class="loader"></div>
	</div>

	</div>
	<p><br /></p>
	<p><br /></p>
	<p><br /></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-2 col-xs-12">
				<div id="get_category">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Categories</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
				<div id="get_brand">
				</div>
				<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Brand</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="row">
					<div class="col-md-12 col-xs-12" id="product_msg">
					</div>
				</div>
				<div class="panel panel-info">
					<div class="panel-heading">Products</div>
					<div class="panel-body">
						<div id="get_product">
							<!--Here we get product jquery Ajax Request-->
						</div>
						<!--<div class="col-md-4">
							<div class="panel panel-info">
								<div class="panel-heading">Samsung Galaxy</div>
								<div class="panel-body">
									<img src="product_images/images.JPG"/>
									 <select id='status'>
									 	<option value='Select'>Select</option>
										<option value='Sale'>Sale</option>
										<option value='Rent'>Rent</option>
										<option value='Exchange'>Exchange</option>
									</select>
								</div>
								<div class="panel-heading">$.500.00
									<button style="float:right;" class="btn btn-danger btn-xs">AddToCart</button>
								</div>
							</div>
						</div> -->
					</div>
					<div class="panel-footer">&copy; 2016</div>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</body>

</html>