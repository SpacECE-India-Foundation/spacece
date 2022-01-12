<?php
include_once './header_local.php';
include_once '../common/header_module.php';
// include_once '../common/banner.php';

// if (!isset($_SESSION['current_user_id']) && !isset($_SESSION['current_user_type'])) {
//     header("Location: ./index.php");
// }
?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="main-content text-centre" style="background: linear-gradient(to bottom right, #ffcc99 10%, #ffffff 100%);">
<div id="admin-page">
<div class="container">
<nav>
    <ul>
        <li><a href="#"><i class="fas fa-home"></i> Dash Board </a></li>
        <li><a href="#"><i class="fas fa-users"></i> Custimers </a></li>
        <li><a href="#"><i class="far fa-bookmark"></i> Products </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Categories </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Orders </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Consultants </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Appointmentd </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Profile </a></li>
        <li><a href="#"><i class="fas fa-home"></i> Settings </a></li>


</ul>
</nav>

</div>



</div>
</div>
<?php
include_once '../common/footer_module.php';
?>