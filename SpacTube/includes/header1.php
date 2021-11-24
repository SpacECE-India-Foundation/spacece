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
  <script src="js/main.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="css/style1.css" /> -->
  <title> Lib for smalls</title>
  <style type="text/css">
    a {
      color: black !important;
      text-decoration: none;
    }

    a:hover {
      color: grey !important;
      text-decoration: none;

    }
  </style>
  <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!-- <link rel="stylesheet" /assets/css/style.css"> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/style.css" />


  <link rel="stylesheet" href="../assets/css/animate.css" />
  <link rel="stylesheet" href="../assets/css/owl.carousel.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" type="text/css" href="../assets/css/jquery.convform.css" />
  <link rel="stylesheet" type="text/css" href="../assets/css/responsive.css" />
  <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui.css" />


  <!--    <link rel="stylesheet" href="../../css/bootstrap.min.css" /> -->


  <link rel="stylesheet" href="css/style.css" />
  <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" /> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->

  <!-- <link rel="stylesheet" type="text/css" href="../../Styles.css" /> -->
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <link rel="stylesheet" type="text/css" href="css/jquery.convform.css" />
  <!-- <link rel="stylesheet" type="text/css" href="../../css/responsive.css" /> -->
  <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
  <link rel="stylesheet" type="text/css" href="css/style1.css" />
  <title>LearnOn</title>
</head>



<div class="navbar navbar-inverse navbar-fixed-top " style="background-color: orange">
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
      <a href="/Khanstore" class="navbar-brand">SPAC-ECE</a>
    </div>

    <div class="collapse navbar-collapse" id="collapse1">
      <ul class="nav navbar-nav">
        <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
        <li><a href="../about.php"><span class="glyphicon glyphicon-modal-window"></span>About Us</a></li>
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
              <!-- <li><a href="customer_order.php">Orders</a></li> -->
              <!-- <li class="divider"></li> -->
              <li><a href="">Change Password</a></li>
              <li class="divider"></li>
              <li>
                <a href='../spacece_auth/logout.php'>
                  <span class="glyphicon glyphicon-log-out"></span>
                  Logout
                </a>
              </li>
            <?php
          } else {
            ?>
              <li>
                <a href='../spacece_auth/login.php?type=customer'>
                  <span class="glyphicon glyphicon-log-in"></span>
                  Login
                </a>
              </li>
              <li>
                <a href="../spacece_auth/register.php?type=customer">
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
          <img src="../img/logo/ConsultUs.jpeg" class=" img img-thumbnail img-circle" style="width:80px;">
        </a>
      </div>
      <a href="/index.php" class="navbar-brand">Spacece Tube</a>
    </div>
    <div class="collapse navbar-collapse" id="collapse">
      <ul class="nav navbar-nav">
        <li><a href="./index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
        <li><a href="../about.php"><i class="fa fa-users"></i></span>About Us</a></li>
        <!-- <li><a href="../feedback.html"><i class="fa fa-envelope" style="color: black"></i></span>Feedback </a></li> -->
        <li><a href="./view.php"><i class="fa fa-envelope" style="color: black"></i></span>Free </a></li>
        <li><a href="./view1.php"><i class="fa fa-envelope" style="color: black"></i></span>Paid </a></li>
        <li><a href="./trending.php"><i class="fa fa-envelope" style="color: black"></i></span>Freee </a></li>
      </ul>


    </div>
  </div>
</div>
</nav>

</div>

<?php

?>
<?php
if (isset($_SESSION['current_user_id'])) {
?>
<?php
} else {
?>
<?php
}
?> <?php
    $page = 'space_active';
    if (isset($_SESSION['u_id'])) {

      if (isset($_SESSION['ConsultUs'])) {
        if ($_SESSION['ConsultUs'] === "active") {



    ?>
    <?php
        } else {
    ?>

<?php
        }
      }
    }
?>
<?php
?>
<?php
if (isset($_SESSION['u_id'])) {
?>
<?php
} else {
?>

<?php
}
?>
</div>