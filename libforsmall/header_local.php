<?php
$main_logo = "../img/logo/SpacECELogo.jpg";
$module_logo = "../img/logo/LibForSmalls.jpeg";
$module_name = "Lib for smalls";
$banner_img = "../img/banner/LibForSmalls.jpeg";

$extra_styles = "
<link rel='stylesheet' href='./css/bootstrap.min.css' />
<link rel='stylesheet' type='text/css' href='./style.css'>";

$extra_scripts = "
<script src='./js/jquery2.js'></script>
<script src='./js/bootstrap.min.js'></script>
<script src='./main.js'></script>";

$extra_profile_links = "
<a href='./customer_order.php'><i class='fas fa-truck'></i><span>Orders</span></a>
";

$extra_main_nav_links = "
<div style='display: inline; position: relative;'>
<a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='fas fa-shopping-bag'></i>Cart<span class='badge'>0</span></a>
<div class='dropdown-menu' style='width:400px; position: absolute; top: 30px;'>
  <div class='panel panel-success'>
    <div class='panel-heading'>
      <div class='row'>
        <div class='col-md-3'>Sl.No</div>
        <div class='col-md-3'>Product Image</div>
        <div class='col-md-3'>Product Name</div>
        <div class='col-md-3'>Price in <?php echo CURRENCY; ?></div>
      </div>
    </div>
    <div class='panel-body'>
      <div id='cart_product'>
        <div class='row'>
          <div class='col-md-3'>Sl.No</div>
          <div class='col-md-3'>Product Image</div>
          <div class='col-md-3'>Product Name</div>
          <div class='col-md-3'>Price in $.</div>
        </div>
      </div>
    </div>
    <div class='panel-footer'></div>
  </div>
</div>
</div>
";
