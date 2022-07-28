<?php
//require "config/constants.php";
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
//session_start();
if (isset($_SESSION["current_user_name"])) {
	header("location:profile.php");
}
?>

<div class="container-fluid" >
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-2 col-xs-12">
			<div id="get_category" style='border:1px solid orange;border-radius:1%;' >
			</div>
			<!--<div class="nav nav-pills nav-stacked">
					<li class="active"><a href="#"><h4>Categories</h4></a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
					<li><a href="#">Categories</a></li>
				</div> -->
			<div id="get_brand" class="mt-2" style='border:1px solid orange; border-radius:1%;' >
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
				<?php
				if(isset($_SESSION['current_user_name'])){
						
					if($_SESSION['current_user_type']=='admin'){
						?>
						<a href="./admin/index.php" class="btn btn-warning">Admin Home</a>
						
						<?php
						
					}
					if($_SESSION['current_user_type']=='book_owner'){
						?>
						<a href="./Book_owner/index.php" class="btn btn-warning">Book Owner</a>
						
						<?php	
					}
					if($_SESSION['current_user_type']=='delivery_boy'){
						?>
						<a href="./delivery_bou/index.php" class="btn btn-warning">Delivery Home</a>
						
						<?php
					}
					if($_SESSION['current_user_type']=='customer'){
						?>
						<a href="./user_dash/index.php" class="btn btn-warning">User Books</a>
				

						<?php
					}

				}

				?>
			</div>
			<div class="panel " style="border:1px solid orange" >
				<div class="panel-heading d-flex justify-content-center" style ="background-color: orange; ">Products</div>
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
				
					
			
				<!-- <div class="panel-footer">&copy; 2016</div> -->
			</div>
			</div>
		</div>
		<!-- <div class="col-md-1"></div> -->
	</div>
</div>
<?php
include_once '../common/footer_module.php';
?>