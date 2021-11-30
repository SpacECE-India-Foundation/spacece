<?php
session_start();
if (!isset($_SESSION['redirect_url']))
  $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

if (isset($_SESSION['current_user_id'])) {
  header("Location: index.php");
}

include_once './header_local.php';
include_once '../common/header_module.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.12.0/bootstrap-social.min.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Login</title>

</head>

<body>
  <div class="login-page">
    <h2>Login</h2>
    <form class="login-form" method="post" autocomplete="off">
      <input type="email" placeholder="Enter Email" name="email" />
      <input type="password" placeholder="Enter Password" name="password" />
      <select name="type" id="user_type">
        <option value="customer">Customer</option>
        <option value="consultant">Consultant</option>
      </select>
      <button type="submit" name="login">Login</button>
      <br>
     

    
      
      <?php
     include './facebook/index.php';
    ?>
    <a id="google-button" class="btn btn-block btn-social btn-google">
        <i class="fa fa-google"></i> Sign in with Google
      </a> 
    <!-- <a id="facebook-button" class="btn btn-block btn-social btn-facebook">
        <i class="fa fa-facebook"></i> Sign in with Facebook
      </a>  -->

      <p class="message">Not registered? <a href="register.php">Create an account</a></p>

    </form>
    <?php
      include './gmail/login.php';
     
    ?>


  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <script type="text/javascript" src="main.js"></script>

  
   
</body>

</html>