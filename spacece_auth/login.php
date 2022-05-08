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
        <option value="admin">Admin</option>
        <option value="book_owner">Book Owner</option>
        <option value="delivery_boy">Delivery Boy</option>
        
      </select>
    </div>
    <button type="submit" name="login">Login</button>
    <br>




   <?php
     //include './google/index.php';//Commented because login was not working on server

    ?> 

    <?php
    //include './facebook/index.php';//Commented because login was not working on server
    ?>



    <p class="message">Not registered? <a href="register.php">Create an account</a></p>

  </form>


</div>

<?php include_once '../common/footer_module.php'; ?>
