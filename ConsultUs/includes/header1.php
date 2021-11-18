<?php
include('constants.php');
//include_once('includes/header.php');
session_start();

error_reporting(0);
///var_dump($_SESSION);
$ref = $_GET['user'];
if (isset($_SESSION['u_id'])) {
  // echo"Hello";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--   <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css"> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/brands.min.css" integrity="sha512-lCU0XyQA8yobR7ychVxEOU5rcxs0+aYh/9gNDLaybsgW9hdrtqczjfKVNIS5doY0Y5627/+3UVuoGv7p8QsUFw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" /assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">

     <link rel="stylesheet" href="../assets/css/animate.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery.convform.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui.css" /> -->


  <!--    <link rel="stylesheet" href="../../css/bootstrap.min.css" /> -->


  <link rel="stylesheet" href="css/style.css" />
  <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" /> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <!-- <link rel="stylesheet" type="text/css" href="../../Styles.css" /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css" />
  <!-- <link rel="stylesheet" type="text/css" href="../../css/responsive.css" /> -->
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/style1.css" />
  <title>LearnOn</title>
</head>



<div class="Navbar">
  <div class="Navbar__Link Navbar__Link-brand">

    <a href="http://educationfoundation.space/spacece/c_index.html" class="col-sm-1"> <img src="../img/logo/ConsultUs.jpeg " class=" d-flex img-fluid" style="" alt="" /></a>


  </div>
  <div class="Navbar__Link Navbar__Link-toggle">
    <i class="fa fa-bars"></i>
  </div>
  <nav class="Navbar__Items mt-3">
    <div class="Navbar__Link ">
      <strong><a href="http://educationfoundation.space/spacece/c_index.html" style="color: black"><i class="fa fa-home"></i>HOME</a></strong>

    </div>
    <div class="Navbar__Link">
      <strong><a href="http://educationfoundation.space/ConsultUs/about.html" style="color: black"><i class="fa fa-users"></i> ABOUT US</a></strong>
    </div>
    <div class="Navbar__Link">
      <strong><a href="http://educationfoundation.space/ConsultUs/contact.html" style="color: black"><i class="fa fa-envelope" style="color: black"></i> FEEDBACK</a></strong>
    </div>
    <div>
      <?php
      $page = 'space_active';
      if (isset($_SESSION['u_id'])) {

        if (isset($_SESSION['space_active'])) {
          // echo$_SESSION['space_active'];
          if ($_SESSION['space_active'] === "active") {


            $url = BASE_URL;
      ?>
            <div class="form-group row ">
              <div class="col" id="daysleft"></div>
            </div>
          <?php
          } else {
          ?>
            <div>

              <button id="pack" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#PackModal">Buy Packs Now</button>

        <?php
          }
        }
      }
        ?>
            </div>
  </nav>
  <nav class="Navbar__Items Navbar__Items--right">
    <div class="Navbar__Link pull-xl-1">

      <div class="row">
        <div>

          <a href="https://www.facebook.com/SpacECEIn"><i class="fa fa-facebook  px-1 ml-5"></i></a>
          <a href="https://www.instagram.com/spacece.in/"><i class="fa fa-instagram px-1 ml-5"></i></a>
          <a href="https://t.me/joinchat/EtMJq_3BKL4zNGE1"><i class="fa fa-telegram px-1 ml-5" aria-hidden="true"></i></a>
          <a href="https://www.linkedin.com/company/spacece-co/"><i class="fa fa-linkedin px-1 ml-5"></i></a>

          <div>


            <?php
            if (isset($_SESSION['u_id'])) {
              $url = BASE_URL;
            ?>
              <a href="myinfo.php?user=<?php echo $ref ?>">
                <img align="top-right" src="https://doctoryouneed.org/wp-content/uploads/2020/05/dr-new-demo-image-57.png" alt="ALL DOCTOR DETAILS" width="100" height="100">
                &nbsp&nbsp&nbsp<button>
                  <div class="bottom" style="color: black;" style="font-weight:200;"><b> MY INFO </b></div></a></button>
              <a href='logout.php' class="text-dark"> <i class="fa fa-user-circle-o" style="color: black"></i>Logout</a>
            <?php
            } else {
            ?>

              <a href="register.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>User</b></a>
              <a href="reg_builder.php" style="color:orange;"><i class="fa fa-user-circle-o" style="color:black;"></i><b>Consultant</b></a><br>
              <a href="loginuser.php" style="color:orange;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login USER</b></a>
              <a href="login2.php" style="color:orange;"><i class="fa fa-sign-in" style="color:black;"></i><b>Login Consultant</b></a>
            <?php
            }
            ?>
            </i> </a>


          </div>

        </div>

      </div>
    </div>


  </nav>

</div>




<!-- <div class="modal fade" id="PackModal" tabindex="-1" aria-labelledby="PackModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Available Packs</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="row " id="packdetails">
         
                       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
 -->

<!-- 
        <script type="text/javascript">

            function classToggle() {
  const navs = document.querySelectorAll('.Navbar__Items')
  
  navs.forEach(nav => nav.classList.toggle('Navbar__ToggleShow'));
}

document.querySelector('.Navbar__Link-toggle')
  .addEventListener('click', classToggle);
  var product="SpaceActive";
 
 
 
 
  $(document).ready(function(){
    $.ajax({
      method:'post',
      data:{dates:1,
       },
      url:'../includes/functions.php',
      success:function(result) {
        $("#daysleft").append(result+' : Days left');
        //(result);
        
      }
    });



    $('#pack').on('click',function(){

    
    $.ajax({
      method:'post',
      data:{get:1,
        product:product},
      url:'functions.php',
      success:function(result) {
        $("#packdetails").append(result);
        //alert(result);
        
      }
    });
  });
  })
  



  $(document).on('click','.buy1', function (event) {
  alert($(this).data('id'));
});



        </script> -->