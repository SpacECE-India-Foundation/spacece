<?php
include('../Db_Connection/db_spacece.php');

include_once './header_local.php';
include_once '../common/header_module.php';

if (!isset($_SESSION['redirect_url']))
  $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

$redirectUrl = $_SESSION['redirect_url'];

?>

<div class="profile-page">
  <h2>Profile</h2>
  <form class="profile-form" method="post" autocomplete="off">
    <div class="form-group" id="js-pro-pic">
      <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80" alt="Name">
      <div class="file-input" style="display: none;">
        <input type="file" class="fileToUpload" style="padding: 15px 30px;" name="fileToUpload" accept="image/*" id="fileToUpload" />
        <label for="file">Change Profile Picture
        </label>
      </div>
      <p class="file-name"></p>
    </div>
    <div class="form-group" id="js-name">
      <label for="name">Name</label>
      <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name" value="" disabled />
    </div>
    <div class="form-group" id="js-email">
      <label for="email">Email</label>
      <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" value="" disabled />
    </div>
    <div class="form-group" id="js-phone">
      <label for="phone">Mobile No.</label>
      <input type="text" class="form-control" placeholder="Enter Mobile No." id="phone" name="phone" value="" disabled />
    </div>
    <!-- Change Password Functionality -->
    <button type="button" id="change_password" style="display: none;">Change Password</button>

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