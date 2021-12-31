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
<<<<<<< HEAD
    <div class="form-group" id="js-email">
      <label for="email">Email</label>
      <input type="email" class="form-control" placeholder="Enter Email" id="email" name="email" value="<?= get_input_value($row, 'u_email'); ?>" />
=======
   
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
         <input type="text" class="form-control   mb-3" name="mobile" id="mobile" maxlength="10" value="<?php echo $data['u_mob'] ?>" placeholder="Enter your mobile number" >
         <input type="text" class="form-control   mb-3" name="type" id="type" value="<?php echo $data['u_type'] ?>"readonly>
         <Input type="submit" id="save" name="save" class="btn btn-primary form-control" value="Save changes">
        </div>
         
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
>>>>>>> 80931b8db5f836ffff63ec7a4f5341b119bc566c
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