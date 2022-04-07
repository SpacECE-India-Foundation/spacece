<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
include '../Db_Connection/db_khanstore.php';
//session_start();
if (!isset($_SESSION["current_user_name"])) {
	header("location:index.php");
}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-2">
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
		<div class="col-md-8">
			<div class="row">
				<div class="col-md-12 col-xs-12" id="product_msg">
				</div>
			</div>
			<div class="panel panel-info" id="scroll">
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
								</div>
								<div class="panel-heading">$.500.00
									<button style="float:right;" class="btn btn-danger btn-xs">AddToCart</button>
								</div>
							</div>
						</div> -->
				</div>
				<!-- <div class="panel-footer">&copy; 2016</div> -->
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<center>
				<ul class="pagination" id="pageno">
					<li><a href="#">1</a></li>
				</ul>
			</center>
		</div>
	</div>
</div>
<?php
include_once '../common/footer_module.php';
?>