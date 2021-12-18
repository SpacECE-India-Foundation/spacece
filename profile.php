<?php
$main_logo = "./img/logo/SpacECELogo.jpg";
$module_logo = null;
$module_name = null;
$main_page = true;

$extra_styles = "
<link rel='stylesheet' href='./css/font-awesome.min.css' />
<link rel='stylesheet' href='./css/animate.css' />
<link rel='stylesheet' href='./css/owl.carousel.css' />
<link rel='stylesheet' href='./css/style.css' />
<link rel='stylesheet' href='./css/profile.css' />
<link
  rel='stylesheet'
  href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'
/>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>

<link rel='stylesheet' type='text/css' href='./Styles.css' />
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<link rel='stylesheet' type='text/css' href='./css/jquery.convform.css' />
<link rel='stylesheet' type='text/css' href='./css/responsive.css' />
<link rel='stylesheet' type='text/css' href='./css/jquery-ui.css' />
<link rel='stylesheet' type='text/css' href='./css/share.css' />
<link rel='stylesheet' href='https://pro.fontawesome.com/releases/v5.10.0/css/all.css' integrity='sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p' crossorigin='anonymous'/>";

$extra_scripts = "<script src='./js/jquery-3.2.1.min.js'></script>
<script src='./js/bootstrap.min.js'></script>
<script src='./js/owl.carousel.min.js'></script>
<script src='./js/masonry.pkgd.min.js'></script>
<script src='./js/magnific-popup.min.js'></script>
<script src='./js/main.js'></script>
<script type='js/jquery.js'></script>
<script type='text/javascript' src='./js/jquery-3.1.1.min.js'></script>
<script type='text/javascript' src='./js/jquery.convform.js'></script>
<script type='text/javascript' src='./js/custom.js'></script>
<script type='text/javascript' src='./js/jquery-1.12.4.js'></script>
<script type='text/javascript' src='./js/jquery-ui.js'></script>
<script type='text/javascript' src='./js/bootstrap.min.js'></script>";

include_once './common/header_module.php';
?>
<style>
  
</style>
 
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">  -->


  <div class="row d-flex justify-content-center mt-1 mb-1 ">
    <div class="col-sm-9 " style="">
        <div class="profile-image float-lg-right"  style="width:120px;border-radius:60px; border:2px solid white; margin-right:-75px;  position:relative;  background-repeat: no-repeat;margin-top: 10%;" >
        <img src="https://cdn-icons-png.flaticon.com/512/21/21104.png" style="width:120px; border:5px solid white;border-radius:70px;"  class="img img-responsive ">
        </div>
<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div style="font-size: 0.5rem;">
<button class="btn btn-sm col-sm-1  " style="float: right;"> <i class="far fa-edit fa-xs"></i></button>
</div>

<label for="">First Name :</label>
<label for="">Last Name :</label>
<label for="">Email Name :</label>
</div>

<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div style="font-size: 0.5rem;">
<button class="btn btn-sm col-sm-1  " style="float: right;"> <i class="far fa-edit fa-xs"></i></button>
<h5>Recent Activity</h5>
</div>
</div>
</div>
    </div>
   
    <div class=" col-sm-3 float-lg-right" style="background-color: orange; border-radius:12px; z-index: -1;">
      
    </div>
   


</div>
</div>
</div>
<div></div>
<nav class="menu">
   <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open" />
   <label class="menu-open-button" for="menu-open">
    <i class="fa fa-share-alt share-icon"></i>
  </label>

   <a href="https://www.facebook.com" target="_blank" class="menu-item facebook_share_btn"> <i class="fa fa-facebook"></i> </a>
   <a href="https://www.twitter.com" target="_blank" class="menu-item twitter_share_btn"> <i class="fa fa-twitter"></i> </a>
   <a href="https://www.pinterest.com" target="_blank" class="menu-item pinterest_share_btn"> <i class="fa fa-pinterest"></i> </a>
   <a href="https://www.youtube.com" target="_blank" class="menu-item youtube_share_btn"> <i class="fa fa-youtube"></i> </a>
   <a href="https://www.tumblr.com" target="_blank" class="menu-item tumblr_share_btn"> <i class="fa fa-tumblr"></i> </a>
   <a href="https://plus.google.com" target="_blank" class="menu-item google_plus_share_btn"> <i class="fa fa-google-plus"></i> </a>
</nav>
<?php
include_once './common/footer_module.php';
?>