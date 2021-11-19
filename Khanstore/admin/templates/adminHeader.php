<?php
//require "constants.php";
//session_start();

// if (isset($_SESSION["uid"])) {
//   //header("location:profile.php");
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">



    <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">  -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->

    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
    


    <link rel="stylesheet" href="css/style.css" />

<!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  
  
    <!-- <link rel="stylesheet" type="text/css" href="css/jquery.convform.css" /> -->
   
    <!-- <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" /> -->
    <script src="main.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="css/style1.css" /> -->
    <title> Lib for smalls</title>
    <style type="text/css">
      a{
        color: black !important;
        text-decoration:none;
      }
      a:hover {
        color: grey !important;
        text-decoration:none;

      }
    </style>
</head>

   <div class="navbar navbar-inverse navbar-fixed-top "  style="background-color: orange" >
    <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse1" aria-expanded="false">
        <span class="sr-only">navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <div class="navbar-brand">
     
     <a href='../index.php'>
       <img src="../img/logo/SpacECELogo.jpg" class=" img img-thumbnail img-circle" style="width:80px; top:0px;">
     </a>
   </div>
   <a href="/Khanstore" class="navbar-brand">Space Active</a>
 </div>
 
 <div class="collapse navbar-collapse" id="collapse1">
 <ul class="nav navbar-nav">
     <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
     <li><a href="./index.php"><span class="glyphicon glyphicon-modal-window"></span>About Us</a></li>
     <form class="navbar-form navbar-left">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" id="search">
        </div>
        <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
      </form>
   </ul>
   <ul class="nav navbar-nav navbar-right">
  <?php
        if (isset($_SESSION['current_user_id'])) {
        ?>
        <li>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : "User" ?></a>
            <ul class="dropdown-menu">
              <li><a href="./customer_profile/index.php"><span class="glyphicon glyphicon-user">Profile</a></li>
              <li class="divider"></li>
              <li><a href="customer_order.php">Orders</a></li>
              <li class="divider"></li>
              <li><a href="">Change Password</a></li>
              <li class="divider"></li>
              <li>
                <a href='../spacece_auth/logout.php'>
                  <span class="glyphicon glyphicon-log-out"></span>
                  Logout
                </a>
              </li>
<?php
        }
else{
  ?>
  <li>
            <a href='../spacece_auth/login.php'>
              <span class="glyphicon glyphicon-log-in"></span>
              Login
            </a>
          </li>
          <li>
            <a href="../spacece_auth/register.php">
              <span class="glyphicon glyphicon-user"></span>
              Register
            </a>
          </li>
          <?php

}
        ?>

  </ul>
  </div>
  
  <br>
  <br>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
          <span class="sr-only">navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand">
          <a href='./index.php'>
        <img src="../img/logo/LibForSmalls.jpeg" class=" img img-thumbnail img-circle" style="width:80px;" >
    </a>
        </div>
        <a href="/Khanstore" class="navbar-brand" >Lib for smalls</a>
      </div>
      <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav">
          <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
          <li><a href="./index.php"><span class="glyphicon glyphicon-modal-window"></span>Product</a></li>
        </ul>
        <!-- <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" id="search">
          </div>
          <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
        </form>
		<li class="nav-item text-nowrap">
 			<?php
				// if (isset($_SESSION['admin_id'])) {
				// ?>
 				<a class="nav-link" href="../admin/admin-logout.php">Sign out</a>
 				//
			//	} else { -->
				//	$uriAr = explode("/", $_SERVER['REQUEST_URI']);
				//	$page = end($uriAr);
				//	if ($page === "login.php") {
				//	?>
 					<!-- <a class="nav-link" href="../admin/register.php">Register</a> -->
 			
				//	} else {
				//	?>
 					<!-- <a class="nav-link" href="../admin/login.php">Login</a> -->
 		//
				//	}
			//	}

			//	?>

 		</li>
         
        </ul> -->
      </div>
    </div> 
  </div>








<!-- <div class="Navbar">
  

   <div class="Navbar__Link Navbar__Link-brand">
    
     <a href="./index.php" class="col-sm-1" > <img src="img/logo/libForSmalls.jpeg " class=" d-flex img-fluid" style=""  alt=""  /></a> 
       
   
    </div>
     <div class="Navbar__Link mt-3">
   <h3 class="">Lib for smalls</h3> 
     </div>
     
    <div class="Navbar__Link Navbar__Link-toggle">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
  <nav class="Navbar__Items mt-3">
    <div class="Navbar__Link ">
            <strong><a href="index.php" style="color: black"><i class="fa fa-home"></i>HOME</a></strong>
               
    </div>
    <div class="Navbar__Link">
     <strong><a href="http://educationfoundation.space/ConsultUs/about.html"style="color: black"><i class="fa fa-users"></i> ABOUT US</a></strong>
    </div>
    <div class="Navbar__Link">
       <strong><a href="http://educationfoundation.space/ConsultUs/contact.html"style="color: black"><i class="fa fa-envelope" style="color: black"></i> FEEDBACK</a></strong>
    </div>
    <form class="navbar-form navbar-left">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search" id="search">
          </div>
          <button type="submit" class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button>
        </form>
          
    <div>
                <?php
                $page='space_active';
                        if(isset($_SESSION['u_id'])){

                          if(isset($_SESSION['ConsultUs']) ){
                           // echo$_SESSION['space_active'];
                          if($_SESSION['ConsultUs']==="active")
                          {

                         
                            
                              ?>
                               <div class="form-group row " ><div class="col" id="daysleft"></div></div>
                                <?php
                            }else{
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
    <ul class="nav navbar-nav navbar-right">
          <li><a href="#"  style="color: black" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
            <div class="dropdown-menu" style="width:400px;">
              <div class="panel panel-success">
                <div class="panel-heading" class="pull-left">
                  <div class="row">
                    <div class="col-md-3">Sl.No</div>
                    <div class="col-md-3">Product Image</div>
                    <div class="col-md-3">Product Name</div>
                    <div class="col-md-3">Price in <?php // echo ////CURRENCY; ?></div>
                  </div>
                </div>
                <div class="panel-body">
                  <div id="cart_product">
                    <div class="row">
                  <div class="col-md-3">Sl.No</div>
                  <div class="col-md-3">Product Image</div>
                  <div class="col-md-3">Product Name</div>
                  <div class="col-md-3">Price in $.</div>
                </div>
                  </div>
                </div>
                <div class="panel-footer"></div>
              </div>
            </div>
          </li></ul>
    <div class="Navbar__Link pull-xl-1 ">
   
     <div class="row ">
            <div class=" col btn">
             
               
                
                    <div>
              
              
                  <?php
                        if(isset($_SESSION['u_id'])){
                            // $url = BASE_URL; 
                              ?>
                                 <a href='logout.php' class="btn text-dark  "  style="color: black;"> <i class="fa fa-user" style="color: black"></i> Log-Out</a>
                                  
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi," . $_SESSION["name"]; ?></a>
            <ul class="dropdown-menu">
              <li><a href="./customer_profile/index.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-user">Profile</a></li>
              <li class="divider"></li>
              <li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
              <li class="divider"></li>
              <li><a href="customer_order.php" style="text-decoration:none; color:blue;">Orders</a></li>
              <li class="divider"></li>
              <li><a href="" style="text-decoration:none; color:blue;">Change Password</a></li>
              <li class="divider"></li>
              <li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
            </ul>
          
                                <?php
                            }else{
                                ?>

                                <a href='login.php' class="text-dark"  style="color: black"> <i class="fa fa-user-circle-o" style="color: black"></i> Login</a>
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
</nav> -->
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

       <script type="text/javascript">

//             function classToggle() {
//   const navs = document.querySelectorAll('.Navbar__Items')
  
//   navs.forEach(nav => nav.classList.toggle('Navbar__ToggleShow'));
// }

// document.querySelector('.Navbar__Link-toggle')
//   .addEventListener('click', classToggle);
//   var product="SpaceActive";
 
 
 
 
//   $(document).ready(function(){
//     $.ajax({
//       method:'post',
//       data:{dates:1,
//        },
//       url:'../includes/functions.php',
//       success:function(result) {
//         $("#daysleft").append(result+' : Days left');
//         //(result);


//     $('#pack').on('click',function(){

    
//     $.ajax({
//       method:'post',
//       data:{get:1,
//         product:product},
//       url:'functions.php',
//       success:function(result) {
//         $("#packdetails").append(result);
//         //alert(result);
        
//       }
//     });
//   });
//   })
  



//   $(document).on('click','.buy1', function (event) {
//   alert($(this).data('id'));
// });



        </script>  



