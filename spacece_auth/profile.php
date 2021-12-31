<?php
include('db.php');

include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url']))
  $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

$redirectUrl = $_SESSION['redirect_url'];

if (!isset($_SESSION['current_user_id'])) {
  header("Location: login.php");
  exit();
}

$query = "SELECT * FROM users WHERE u_id = " . $_SESSION['current_user_id'];
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

function get_input_value($row, $input)
{
  return $row[$input];
}
?>

<div class="profile-page">
  <h2>Profile</h2>
  <form class="profile-form" method="post" autocomplete="off">
    <div class="form-group" id="js-name">
      <label for="name">Name</label>
      <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="<?= get_input_value($row, 'u_name'); ?>" />
    </div>
    <div class="form-group" id="js-email">
      <label for="email">Email</label>
      <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" value="<?= get_input_value($row, 'u_email'); ?>" />
    </div>
    <div class="form-group" id="js-phone">
      <label for="phone">Mobile No.</label>
      <input type="text" class="form-control" placeholder="Enter Mobile No." id="phone" name="phone" value="<?= get_input_value($row, 'u_mob'); ?>" />
    </div>
    <div class="form-group" id="js-password" style="display: none;">
      <label for="password">Password</label>
      <input type="password" class="form-control" placeholder="Enter Password" id="password" name="password" />
    </div>
    <div class="form-group" id="js-confirm-password" style="display: none;">
      <label for="cpassword">Confirm Password</label>
      <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="cpassword" />
    </div>
    <button type="button" id="edit" name="edit_profile">Edit Profile</button>
    <button type="submit" id="update" name="update_profile" style="display: none;">Update Profile</button>
    <br>

  </form>

</div>

<?php include_once '../common/footer_module.php'; ?>