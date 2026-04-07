<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../Db_Connection/db_spacece.php';

if (isset($_POST['password']) && $_POST['reset_link_token'] && $_POST['email']) {
    //var_dump($_POST);
    $emailId = $_POST['email'];
    $token = $_POST['reset_link_token'];

    $password = md5($_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `u_email`='" . $emailId . "'");
    $row = mysqli_num_rows($query);
    if ($row) {
        //var_dump($row);
        mysqli_query($conn, "UPDATE users set  u_password='" . $password . "', reset_link_token='" . NULL . "' ,token_expire='" . NULL . "' WHERE u_email='" . $emailId . "'");
        echo '<div class="container" style="margin-top: 100px; padding-top: 20px;">
    <div class="alert alert-success" style="color: green; font-weight: bold;">
        Congratulations! Your password has been updated successfully. 
        <a href="' . (isset($main_page) ? './spacece_auth/login.php' : '../spacece_auth/login.php') . '">Login</a> with new credentials.
    </div>
</div>';
    } else {
        echo '<div class="container" style="margin-top: 100px; padding-top: 20px;">
    <div class="alert alert-danger" style="color: red; font-weight: bold;">
        Something went wrong ! please try again.
    </div>
</div>';;
    }
}
?>
<footer>
    <?php include_once '../common/footer_module.php'; ?>
</footer>