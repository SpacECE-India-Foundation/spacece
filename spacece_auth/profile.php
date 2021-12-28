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


<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>

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

<script type='text/javascript' src='./js/jquery-1.12.4.js'></script>
<script type='text/javascript' src='./js/jquery-ui.js'></script>
<script type='text/javascript' src='./js/bootstrap.min.js'></script>
<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

include_once './common/header_module.php';
?>
<style>
  
</style>
 
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">  -->
<?php
if(!isset($_SESSION['current_user_email']))
{
  $email=$_SESSION['current_user_email'];
// header('Location:index.php');
// exit();
// }
$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
// $servername = "localhost";
// $username = "root";
// $password = "";
    $dbname = "spaceece";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

  // $email= $_SESSION['current_user_email'];
$sql= "SELECT * FROM `users` WHERE `u_email`='$email' ";

$result =mysqli_query($conn,$sql);

    $row= mysqli_fetch_assoc($result);
foreach($result as $data)
{

 
//  echo '<div class="caption"><h3><img src="data:image/jpeg;base64,'.base64_encode($data['u_image'] ).'"/></h3></div>';
  ?>
<!-- <div class="caption"><h3><img src="data:image/jpeg;base64,'.base64_encode(<?php //echo $data['u_image']; ?> ).'"/></h3></div> -->
  
  



  <div class="row d-flex justify-content-center mt-1 mb-1 ">
    <div class="col-sm-9 " >
        <div class="profile-image float-lg-right"  style="width:120px;border-radius:60px; margin-right:-75px;  position:relative;  background-repeat: no-repeat;margin-top: 10%;" >
       <?php if(!empty($data['u_image'])) {echo '<img src="data:image/jpeg;base64,'.base64_encode($data['u_image'] ).'" style="width:120px; border:5px solid white;border-radius:70px;"  class="img img-responsive ">';}else{
        echo '<img src="img/user.png" style="width:120px; border:5px solid white;border-radius:70px;"  class="img img-responsive ">'; } ?>;
        </div>
<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div style="font-size: 0.5rem;">
<button class="btn btn-sm col-sm-1  " style="float: right;" data-toggle="modal" data-target="#Edit"> <i class="far fa-edit fa-xs"></i></button>
</div>

<div class="row ml-2"><label for="">First Name : </label> <?php echo $data['u_name'] ?></div>
<div class="row ml-2"><label for="">Email :</label><?php echo $data['u_email'] ?></div>
<div class="row ml-2"><label for="">Phone :</label><?php echo $data['u_mob'] ?></div>
<div class="row ml-2"><label for=""> User Type :</label><?php echo $data['u_type'] ?></div>
</div>

<div class="card shadow p-3 mb-5 bg-white rounded ml-3 col-sm-10" style="border-radius:20px;">
<div style="font-size: 0.5rem;">
<button class="btn btn-sm col-sm-1  " style="float: right;"> <i class="far fa-edit fa-xs"></i></button>
<h5>Recent Activity</h5>
</div>
</div>
</div>
    </div>
   
    <?php
}
}
?>
    <div class=" col-sm-3 float-lg-right" style="background-color: orange; border-radius:12px; z-index: -1;">
      
    </div>
   
    <div class="modal fade" id="Edit" tabindex="-1" role="dialog" aria-labelledby="Edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Edit">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center ">
       <form method="POST" id= "edit_profile" >
         <div class="container  ">
         <input type="text" class="form-control  mb-3" name="name" id="name" value="<?php echo $data['u_name'] ?>" placeholder="Enter Your name">
         <input type="email" class="form-control   mb-3" name="email" id="email" value="<?php echo $data['u_email'] ?>" placeholder="Enter Your Email" readonly>
         <input type="text" class="form-control   mb-3" name="mobile" id="mobile" value="<?php echo $data['u_mob'] ?>" placeholder="Enter your mobile number" >
         <input type="text" class="form-control   mb-3" name="type" id="type" value="<?php echo $data['u_type'] ?>"readonly>
         <Input type="submit" id="save" name="save" class="btn btn-primary form-control" value="Save changes">
        </div>
         
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

</div>
</div>
</div>
<div></div>
<!-- <nav class="menu">
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
</nav> -->
</div>
</div>
<?php
include_once './common/footer_module.php';
?>
<script>
  $('#save').on('click',function(){
var email=$('#email').val();
var name=$('#name').val();
var mobile=$('#mobile').val();
var type='<?php echo $data['u_type'] ?>';
//alert(type);
$.ajax({
  method:'POST',
  data:{
    email:email,
    name:name,
    mobile:mobile,
    type:type,
    update:1
  },async: true,
  url:'./profile_action.php',
  beforeSend: function() {
        // setting a timeout
        $('#Edit').show();
    },
  success:function(data){
   //alert(data);
if(data==='Success'){
  swal("Good job!", "Profile is Updated !", "success");

}else{
  swal("Error!", "Unable to Update", "error");
} 
  }
})
  })
</script>