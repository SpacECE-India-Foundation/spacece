<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if (isset($_POST["userSelectProduct"])) {
	$user = $_SESSION['current_user_id'];
	$cust_product = "select * from products where user_id='$user'";
	$run_query = mysqli_query($con, $cust_product);
	if (mysqli_num_rows($run_query) > 0) {
		$str = "";
		while ($row = mysqli_fetch_array($run_query)) {
			$str .= "<option value='{$row['product_id']}'>{$row['product_title']}</option>";
		}
		echo $str;
	}
}
if (isset($_POST["getItem"])) {
	$item = $_POST["item"];
	$user = $_SESSION['current_user_id'];
	$cust_product = "select * from products where user_id='$user' AND product_id='$item'";
	$run_query = mysqli_query($con, $cust_product);
	if (mysqli_num_rows($run_query) > 0) {
		$str = "";
		$row = mysqli_fetch_array($run_query);
		$str = $row['exchange_price'];

		echo $str;
	}
}
if (isset($_POST["category"])) {
	$category_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
if (isset($_POST["brand"])) {
	$brand_query = "SELECT * FROM brands";
	$run_query = mysqli_query($con, $brand_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Brands</h4></a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$bid = $row["brand_id"];
			$brand_name = $row["brand_title"];
			echo "
					<li><a href='#' class='selectBrand' bid='$bid'>$brand_name</a></li>
			";
		}
		echo "</div>";
	}
}
if (isset($_POST["page"])) {
	$sql = "SELECT * FROM products";
	$run_query = mysqli_query($con, $sql);
	$count = mysqli_num_rows($run_query);
	$pageno = ceil($count / 9);
	for ($i = 1; $i <= $pageno; $i++) {
		echo "
			<li><a href='#' page='$i' id='page'>$i</a></li>
		";
	}
}
if (isset($_POST["getProduct"])) {
	$limit = 9;
	if (isset($_POST["setPage"])) {
		$pageno = $_POST["pageNumber"];
		$start = ($pageno * $limit) - $limit;
	} else {
		$start = 0;
	}
	$product_query = "SELECT * FROM products LIMIT $start,$limit";
	$run_query = mysqli_query($con, $product_query);
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$pro_id    = $row['product_id'];
			$pro_cat   = $row['product_cat'];
			$pro_brand = $row['product_brand'];
			$pro_title = $row['product_title'];
			$pro_price = $row['product_price'];
			$pro_image = $row['product_image'];
			echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
									<select class='form-control status'>
										<option value='Rent'>Rent</option>
										<option value='Sale'>Sale</option>
										<option value='Exchange'>Exchange</option>
										<option value='Borrow'>Borrow</option>
									</select>
								</div>
								<div class='panel-heading'>" . CURRENCY . " $pro_price.00
								<button pid='$pro_id' style='float:right; ' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>		
							</div>
						</div>	
			";
		}
	}
}
if (isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"]) || isset($_POST["get_seleted_Filter"])) {
	if (isset($_POST["get_seleted_Category"])) {
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM products WHERE product_cat = '$id'";
	} else if (isset($_POST["selectBrand"])) {
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM products WHERE product_brand = '$id'";
	} else {
		$text = $_POST["text"];
		$sql = "SELECT * FROM products WHERE product_cat LIKE '%$text%' || product_brand LIKE '%$text%' || product_title  LIKE '%$text%' || product_desc LIKE '%$text%'";
	}

	$run_query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($run_query)) {
		$pro_id    = $row['product_id'];
		$pro_cat   = $row['product_cat'];
		$pro_brand = $row['product_brand'];
		$pro_title = $row['product_title'];
		$pro_price = $row['product_price'];
		$pro_image = $row['product_image'];
		echo "
				<div class='col-md-4'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$pro_title</div>
								<div class='panel-body'>
									<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
								</div>
								<div class='panel-heading'>$.$pro_price.00
									<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
								</div>
							</div>
						</div>	
			";
	}
}






if (isset($_POST["get_seleted_data"]) || isset($_POST["text"])) {
	if (isset($_POST["get_seleted_data"])) {
		$text = $_POST["text"];
		$sql = "SELECT DISTINCT product_id, product_title FROM products WHERE product_cat LIKE '%$text%' || product_brand LIKE '%$text%' || product_title  LIKE '%$text%' || product_desc LIKE '%$text%' ";
		// } else if (isset($_POST["selectBrand"])) {
		// 	$id = $_POST["brand_id"];
		// 	$sql = "SELECT * FROM products WHERE product_brand = '$id'";
		// } else {
		// 	$keyword = $_POST["keyword"];
		// 	$sql = "SELECT * FROM products WHERE product_keywords LIKE '%$keyword%'";
	}

	$run_query = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($run_query)) {
		$product_id = $row['product_id'];
		$pro_title = $row['product_title'];
		echo '<option id="option" id=' . $product_id . '>' . $pro_title . '</option>';
		// $pro_id    = $row['product_id'];
		// $pro_cat   = $row['product_cat'];
		// $pro_brand = $row['product_brand'];
		// $pro_title = $row['product_title'];
		// $pro_price = $row['product_price'];
		// $pro_image = $row['product_image'];
		// echo "
		// 		<div class='col-md-4'>
		// 					<div class='panel panel-info'>
		// 						<div class='panel-heading'>$pro_title</div>
		// 						<div class='panel-body'>
		// 							<img src='product_images/$pro_image' style='width:160px; height:250px;'/>
		// 						</div>
		// 						<div class='panel-heading'>$.$pro_price.00
		// 							<button pid='$pro_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>AddToCart</button>
		// 						</div>
		// 					</div>
		// 				</div>	
		// 	";
	}
}














if (isset($_POST["addToCart"])) {


	$p_id = $_POST["proId"];

	$status = $_POST["status"];

	if (isset($_SESSION["current_user_id"])) {

		$user_id = $_SESSION["current_user_id"];

		$sql = "SELECT * FROM cart WHERE p_id = '$p_id' AND user_id = '$user_id'";
		$run_query = mysqli_query($con, $sql);
		$count = mysqli_num_rows($run_query);
		if ($count > 0) {

			echo "
				<div class='alert alert-warning'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is already added into the cart Continue Shopping..!</b>
				</div>
			"; //not in video
		} else {
			if ($status === "Borrow") {
				$end_date =	date($_POST['end_date']);
				echo $end_date;
				$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`,`status`,`end_date` ,`total_duration`) 
			VALUES ('$p_id','$ip_add','$user_id','1','$status','$end_date','15')";
				if (mysqli_query($con, $sql)) {
					echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
				}
			} else {
				$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`,`status`) 
			VALUES ('$p_id','$ip_add','$user_id','1','$status')";
				if (mysqli_query($con, $sql)) {
					echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is Added..!</b>
					</div>
				";
				}
			}
		}
	} else {
		$sql = "SELECT id FROM cart WHERE ip_add = '$ip_add' AND p_id = '$p_id' AND user_id = -1";
		$query = mysqli_query($con, $sql);
		if (mysqli_num_rows($query) > 0) {
			echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is already added into the cart Continue Shopping..!</b>
					</div>";
			exit();
		}
		$sql = "INSERT INTO `cart`
			(`p_id`, `ip_add`, `user_id`, `qty`,`status`) 
			VALUES ('$p_id','$ip_add','-1','1','$status')";
		if (mysqli_query($con, $sql)) {
			echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Your product is Added Successfully..!</b>
					</div>
				";
			exit();
		}
	}
}
//user product
if (isset($_POST["getUserProduct"])) {
	$user_pro_query = "SELECT * FROM categories";
	$run_query = mysqli_query($con, $category_query) or die(mysqli_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categories</h4></a></li>
	";
	if (mysqli_num_rows($run_query) > 0) {
		while ($row = mysqli_fetch_array($run_query)) {
			$cid = $row["cat_id"];
			$cat_name = $row["cat_title"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_name</a></li>
			";
		}
		echo "</div>";
	}
}
//Count User cart item
if (isset($_POST["count_item"])) {
	//When user is logged in then we will count number of item in cart by using user session id
	if (isset($_SESSION["current_user_id"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[current_user_id]";
	} else {
		//When user is not logged in then we will count number of item in cart by using users unique ip address
		$sql = "SELECT COUNT(*) AS count_item FROM cart WHERE ip_add = '$ip_add' AND user_id < 0";
	}

	$query = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($query);
	echo $row["count_item"];
	exit();
}
//Count User cart item

//Get Cart Item From Database to Dropdown menu
if (isset($_POST["Common"])) {

	if (isset($_SESSION["current_user_id"])) {
		//When user is logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_cat,a.product_image,a.deposit,a.rent_price,b.id,b.qty,b.total_duration,b.status ,b.start_date,b.end_date ,b.exchange_price FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[current_user_id]'";
	} else {
		//When user is not logged in this query will execute
		$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_cat,a.product_image,a.deposit,a.rent_price,b.id,b.qty,b.total_duration,b.status, b.start_date,b.end_date ,b.exchange_price FROM products a,cart b WHERE a.product_id=b.p_id AND b.ip_add='$ip_add' AND b.user_id < 0";
	}
	$query = mysqli_query($con, $sql);
	if (isset($_POST["getCartItem"])) {
		//display cart item in dropdown menu
		if (mysqli_num_rows($query) > 0) {
			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				echo '
					<div class="row">
						<div class="col-md-3">' . $n . '</div>
						<div class="col-md-3"><img class="img-responsive" src="product_images/' . $product_image . '" /></div>
						<div class="col-md-3">' . $product_title . '</div>
						<div class="col-md-3">' . CURRENCY . '' . $product_price . '</div>
					</div>';
			}
?>
			<a style="float:right;" href="cart.php" class="btn btn-warning">Edit&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
<?php
			exit();
		}
	}
	if (isset($_POST["checkOutDetails"])) {
		if (mysqli_num_rows($query) > 0) {
			//display user cart item with "Ready to checkout" button if user is not login

			echo "<form method='post' action='../spacece_auth/login.php'>";
			$n = 0;
			while ($row = mysqli_fetch_array($query)) {
				$n++;
				$product_id = $row["product_id"];
				$product_title = $row["product_title"];
				$product_price = $row["product_price"];
				$product_image = $row["product_image"];
				$cart_item_id = $row["id"];
				$qty = $row["qty"];
				$total_duration = $row["total_duration"];
				$status = strtolower($row["status"]);
				$start_date = $row["start_date"];
				$end_date = $row["end_date"];
				$price = $row["exchange_price"];
				$deposit = $row["deposit"];
				$rent_price = $row["rent_price"];
				$cat = $row["product_cat"];
				echo $status;
				if ($status == "exchange") {
					$sql2 = "SELECT * FROM products where product_cat='$cat' ";
					$query1 = mysqli_query($con, $sql2);
					$pro_title = null;
					$p_id = null;
					$exc_price = null;
					while ($row1 = mysqli_fetch_array($query1)) {

						$p_id .= $row1['product_id'] . ',';

						$exc_price .= $row1['exchange_price'] . ',';
						$pro_title .= $row1["product_title"] . ',';
					}
					//var_dump($exc_price);
					$str_arr = explode(",", $pro_title);
					$p_id = explode(",", $p_id);
					$e_price = explode(",", $exc_price);
					//print_r($e_price[0]);
					echo
					'<div class="row">
								<div class="col-md-2"><br><br>
								<div class="btn-group">
									<a href="#" remove_id=' . $product_id . ' class="btn btn-danger remove"><span class="glyphicon glyphicon-trash" return false></span></a>
									<a href="#" update_id=' . $product_id . ' class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign" return false></span> Save</a>
								</div>
							</div>
								<input type="hidden" name="product_id[]" value=' . $product_id . '/>
								<input type="hidden" name="" value=' . $cart_item_id . '/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/' . $product_image . '"></div>
								<div class="col-md-3"><h4>Product Name: ' . $product_title . '</h4>
								Start Date: <input type="date" class="form-control start_date" value=' . $start_date . '><br>
								<input type="hidden" class="form-control statusInfo"  value=' . $status . ' readonly="readonly"><br>
								Quantity: <input type="text" class="form-control qty" value=' . $qty . '><br>
								Product Price: <input type="text" class="form-control price" value=' . $product_price . ' readonly="readonly"><br>
								<input type="hidden" class="form-control total"  readonly="readonly"><br>
								Exchange Price:<input type="text" class="form-control " id="exp" value=' . $e_price[0] . ' readonly="readonly"><br>
								<div>Exchange: <select class="form-control" id="select_user_products">';
					foreach (array_combine($p_id, $str_arr) as $p_id =>  $str_arr) {
						//var_dump($str_arr);
						echo '<option data-id=' . $p_id . '>' . $str_arr . '</option>';
					}


					echo '</select><br></div>';
				} else if ($status == "rent") {
					echo
					'<div class="row">
								<div class="col-md-2"><br><br>
								<div class="btn-group">
									<a href="#" remove_id=' . $product_id . ' class="btn btn-danger remove"><span class="glyphicon glyphicon-trash" return false></span></a>
									<a href="#" update_id=' . $product_id . ' class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign" return false> Save</span></a>
								</div>
							</div>
								<input type="hidden" name="product_id[]" value=' . $product_id . '/>
								<input type="hidden" name="" value=' . $cart_item_id . '/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/' . $product_image . '"></div>
								<div class="col-md-3"><h4>Product Name: ' . $product_title . '</h4>
								Start Date: <input type="date" class="form-control start_date" value=' . $start_date . '><br>
								
								Quantity: <input type="text" class="form-control qty" value=' . $qty . ' ><br>
								Product Price(PerDay): <input type="text" class="form-control price" value=' . $rent_price . ' readonly="readonly"><br>
								Deposit: <input type="text" class="form-control deposit" value=' . $deposit . ' readonly="readonly"><br>	
								</div>
								<input type="hidden" class="form-control total" value=' . $product_price . ' readonly="readonly"><br>
								<input type="hidden" class="form-control total_duration" value=' . $total_duration . ' readonly="readonly"><br>
		
								<input type="hidden" class="form-control statusInfo"  value=' . $status . ' readonly="readonly"><br>
								
								
							</div><br>';
				} else if ($status == "sale") {


					echo
					'<div class="row">
									<div class="col-md-2"><br><br>
									<div class="btn-group">
										<a href="#" remove_id="' . $product_id . '" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash" return false></span></a>
										<a href="#" update_id="' . $product_id . '" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign" return false> Save</span></a>
									</div>
								</div>
								<input type="hidden" name="product_id[]" value="' . $product_id . '"/>
								<input type="hidden" name="" value="' . $cart_item_id . '"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/' . $product_image . '"></div>
								<div class="col-md-3"><h4>Product Name: ' . $product_title . '</h4>
								Quantity: <input type="text" class="form-control qty" value="' . $qty . '" ><br>
								Product Price: <input type="text" class="form-control price" value="' . $product_price . '" readonly="readonly"><br>
									
								</div>
								<input type="hidden" class="form-control total" value="' . $product_price . '" readonly="readonly"><br>
								<input type="hidden" class="form-control total_duration" value="' . $total_duration . '" readonly="readonly"><br>
								
								<input type="hidden" class="form-control statusInfo"  value="' . $status . '" readonly="readonly"><br>
							</div><br>';
				} else if ($status == "borrow") {
					echo
					'<div class="row">
								<div class="col-md-2"><br><br>
								<div class="btn-group">
									<a href="#" remove_id="' . $product_id . '" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash" return false></span></a>
									<a href="#" update_id="' . $product_id . '" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign" return false> Save</span></a>
								</div>
							</div>
								<input type="hidden" name="product_id[]" value="' . $product_id . '"/>
								<input type="hidden" name="" value="' . $cart_item_id . '"/>
								<div class="col-md-2"><img class="img-responsive" src="product_images/' . $product_image . '"></div>
								<div class="col-md-3"><h4>Product Name: ' . $product_title . '</h4>
								Start Date: <input type="date" class="form-control start_date" value=' . $start_date . '><br>
								
								Quantity: <input type="text" class="form-control qty" value="' . $qty . '" ><br>
								
								
								</div>
								<input type="hidden" class="form-control total" value="' . $product_price . '" readonly="readonly"><br>
								<input type="hidden" class="form-control total_duration" value="' . $total_duration . '" readonly="readonly"><br>
		
								<input type="hidden" class="form-control statusInfo"  value="' . $status . '" readonly="readonly"><br>
								
								
							</div><br>';
				}
			}

			echo '<div class="row">
					<br><div class="col-md-8"></div>
					<div class="col-md-3">
					<b class="net_total" style="font-size:20px; margin-top:200px;"></b></div>';

			if (!isset($_SESSION["current_user_id"])) {
				echo '<div class="row">
							<br><div class="col-md-8"></div>
							<div class="col-md-2"><input type="submit" style="float:right;" name="login_user_with_product" class="btn btn-info btn-lg " value="Ready to Checkout" >
							</form></div>';
			} else if (isset($_SESSION["current_user_id"])) {
				//Paypal checkout form
				echo '
						</form>
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_cart">
							<input type="hidden" name="business" value="shoppingcart@khanstore.com">
							<input type="hidden" name="upload" value="1">';

				$x = 0;
				$sql = "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[current_user_id]'";
				$query = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_array($query)) {
					$x++;
					echo
					'<input type="hidden" name="item_name_' . $x . '" value="' . $row["product_title"] . '">
								  	 <input type="hidden" name="item_number_' . $x . '" value="' . $x . '">
								     <input type="hidden" name="amount_' . $x . '" value="' . $row["product_price"] . '">
								     <input type="hidden" name="quantity_' . $x . '" value="' . $row["qty"] . '">';
				}
				echo
				'<input type="hidden" name="return" value="payment_success.php"/>
					                <input type="hidden" name="notify_url" value="payment_success.php">
									<input type="hidden" name="cancel_return" value="cancel.php"/>
									<input type="hidden" name="custom" value="' . $_SESSION["current_user_id"] . '"/>
									<input style="float:right;margin-right:80px;" type="image" name="submit" id="paymentInit"
									data-name="' . $_SESSION['current_user_name'] . '"
									data-email="' . $_SESSION['current_user_email'] . '"
									data-mobile="' . $_SESSION['current_user_mob'] . '"
										src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/blue-rect-paypalcheckout-60px.png" alt="PayPal Checkout"
										alt="PayPal - The safer, easier way to pay online">

								</form>';
			}
		}
	}
}

//Remove Item From cart
if (isset($_POST["removeItemFromCart"])) {
	$remove_id = $_POST["rid"];
	if (isset($_SESSION["current_user_id"])) {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND user_id = '$_SESSION[current_user_id]'";
	} else {
		$sql = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip_add'";
	}
	if (mysqli_query($con, $sql)) {
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Product is removed from cart</b>
				</div>";
		exit();
	}
}


//Update Item From cart
if (isset($_POST["updateCartItem"])) {
	$update_id = $_POST["update_id"];
	$qty = $_POST["qty"];
	$selectItem = $_POST["selectItem"];
	$item = $_POST["item"];
	if ($selectItem == "" || $item == "") {
		$selectItem = 0;
		$item = 0;
	}
	if (isset($_POST["start_date"]) && isset($_POST["end_date"])) {
		$start_date = $_POST["start_date"];
		$end_date = $_POST["end_date"];
		$start = strtotime($start_date);
		$end = strtotime($end_date);
		$days_between = ceil(abs($end - $start) / 86400);
		if ($start_date == "") {
			echo "<div class='alert alert-danger'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Start date is missing</b>
					</div>";
		} else if ($end_date == "") {
			echo "<div class='alert alert-danger'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>End date is missing </b>
					</div>";
		} else {
			if (isset($_SESSION["current_user_id"])) {
				$sql = "UPDATE cart SET qty='$qty',start_date='$start_date', end_date='$end_date',total_duration='$days_between',exchange_price='$selectItem',exchange_product='$item' WHERE p_id = '$update_id' AND user_id = '$_SESSION[current_user_id]'";
			} else {
				$sql = "UPDATE cart SET qty='$qty',start_date='$start', end_date='$end',total_duration='$days_between',exchange_price='$selectItem',exchange_product='$item' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
			}
			if (mysqli_query($con, $sql)) {
				echo "<div class='alert alert-info'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is updated</b>
					</div>";
				exit();
			}
		}
	} else {
		if (isset($_SESSION["current_user_id"])) {
			$sql = "UPDATE cart SET qty='$qty',exchange_price='$selectItem' WHERE p_id = '$update_id' AND user_id = '$_SESSION[current_user_id]'";
		} else {
			$sql = "UPDATE cart SET qty='$qty',exchange_price='$selectItem' WHERE p_id = '$update_id' AND ip_add = '$ip_add'";
		}
		if (mysqli_query($con, $sql)) {
			echo "<div class='alert alert-info'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Product is updated</b>
					</div>";
			exit();
		}
	}
}

if (isset($_POST['getPrice'])) {
	$id = $_POST['id'];
	$sql2 = "SELECT exchange_price FROM products where product_id='$id' ";
	$query1 = mysqli_query($con, $sql2);
	$result = mysqli_fetch_assoc($query1);
	echo $result['exchange_price'];
}
