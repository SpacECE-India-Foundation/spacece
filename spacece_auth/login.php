<?php
include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url']))
  $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

$redirectUrl = $_SESSION['redirect_url'];

if (isset($_SESSION['current_user_id'])) {
  header("Location: " . $redirectUrl);
  exit();
}
?>

<div class="login-page">
  <h2>Login</h2>
  <form class="login-form" method="post" autocomplete="off">
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" placeholder="Enter Email" name="email" />
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" placeholder="Enter Password" name="password" />
    </div>
    <div class="form-group">
      <label for="name">User Type</label>
      <select name="type" id="user_type">
        <option value="customer">Customer</option>
        <option value="consultant">Consultant</option>
      </select>
    </div>
    <button type="submit" name="login">Login</button>
    <br>
    <!-- bug id -0000114 -->
    <!-- <a id="google-button" href="https://www.google.com/account/about/" class="btn btn-block btn-social btn-google ">
        <i class="fa fa-google"></i> Sign in with Google
      </a>
      <a id="facebook-button" href="https://www.facebook.com/" class="btn btn-block btn-social btn-facebook">
        <i class="fa fa-facebook"></i> Sign in with Facebook
      </a> -->



    <?php
    require_once './gmail/gmaillogin.php';

    ?>

    <?php
    include './facebook/index.php';
    ?>


    <!-- <a id="google-button" class="btn btn-block btn-social btn-google">
        <i class="fa fa-google"></i> Sign in with Google
      </a>  -->
    <!-- <a id="facebook-button" class="btn btn-block btn-social btn-facebook">
        <i class="fa fa-facebook"></i> Sign in with Facebook
      </a>  -->

    <p class="message">Not registered? <a href="register.php">Create an account</a></p>

  </form>


</div>

<?php include_once '../common/footer_module.php'; ?>