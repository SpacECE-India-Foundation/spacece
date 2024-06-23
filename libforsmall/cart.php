<?php
error_reporting(0);
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../common/banner.php';
session_start();
include "../Db_Connection/db_libforsmall.php";
?>

<div class="container">
	<div class="row">

		<div class="col-md-12" id="cart_msg">
			<!--Cart Message-->
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-primary">
				<div class="panel-heading">Cart Checkout</div>
				<div class="panel-body">
					<div class="row cart-items">
						<!--<div class="col-md-2 col-xs-2"><b>Action</b></div>
							<div class="col-md-1 col-xs-2"><b>Product Image</b></div>
							<div class="col-md-1 col-xs-2"><b>Product Name</b></div>
							<div class="col-md-2 col-xs-1"><b>Start Date</b></div>
							<div class="col-md-2 col-xs-1"><b>Return Date</b></div>
							<div class="col-md-1 col-xs-2"><b>Quantity</b></div>
							
							<div class="col-md-1 col-xs-2"><b>Product Price</b></div>
							<div class="col-md-2 col-xs-2"><b>Exchange</b></div>-->
					</div>
					<div id="cart_checkout" class="cart_checkout"></div>
					<!--<div class="row">
							<div class="col-md-2">
								<div class="btn-group">
									<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
									<a href="" class="btn btn-primary"><span class="glyphicon glyphicon-ok-sign"></span></a>
								</div>
							</div>
							<div class="col-md-2"><img src='product_images/imges.jpg'></div>
							<div class="col-md-2">Product Name</div>
							<div class="col-md-2"><input type='date' class='form-control' value='1' ></div>
							<div class="col-md-2"><input type='date' class='form-control' value='1' ></div>
							<div class="col-md-2"><input type='text' class='form-control' value='1' ></div>
							<div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
							<div class="col-md-2"><input type='text' class='form-control' value='5000' disabled></div>
							<div class="col-md-2">Product Name</div>
						</div> -->
					<!--<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<b>Total $500000</b>
							</div> -->

				</div>
				<!-- <div class="panel-footer"></div> -->
			</div>
		</div>


	</div>
	
	<?php
	include_once '../common/footer_module.php';
	?>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
	<script>
	$(function () {
          $('.end_date').datetimepicker({
			
              format: 'MM/YYYY'
          });
      });
	
</script>