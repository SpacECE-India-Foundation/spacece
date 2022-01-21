<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';

// if (!isset($_SESSION['current_user_id']) && !isset($_SESSION['current_user_type'])) {
//     header("Location: ./index.php");
// }
?>
<style>

ul {

  list-style-type: none;
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #fff;
}

li a {
  display: block;
  color: #000;
  padding: 8px 16px;
  text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
  background-color: orange;
  color: white;
}
</style>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 10%, #ffffff 100%);">
<div id="admin-page" class="mt-3">
<div class="container">
<nav>
    <ul>
        <li><a href="#"><i class="fas fa-home"></i> Dash Board </a></li>
        <li><a href="#"><i class="fas fa-users"></i> Custimers </a></li>
        <li><a href="#"><i class="far fa-bookmark"></i> Products </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Categories </a></li>
        <li><a href="#"><i class="fas fa-cart-arrow-down"></i> Orders </a></li>
        <li><a href="#"><i class="fas fa-headphones-alt"></i> Consultants </a></li>
        <li><a href="#"><i class="fas fa-book"></i> Appointmentd </a></li>
        <li><a href="#"><i class="fas fa-users"></i> Profile </a></li>
        <li><a href="#"><i class="fas fa-cogs"></i> Settings </a></li>
        <li><a href="./add_activity.php"><i class="fas fa-plus-circle"></i> Add Activity</a></li>
        <li><a href="./index1.php"><i class="far fa-edit"></i> Edit Activity</a></li>

</ul>
</nav>

</div>



</div>
</div>
<?php
include_once '../common/footer_module.php';
?>