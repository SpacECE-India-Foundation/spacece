<?php
include_once './header_local.php';
include_once '../common/header_module.php';
include_once '../Db_Connection/db_spacece.php';

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="margin-top: 100px; padding-top: 20px; margin-bottom: 50px; padding-bottom: 20px;">
        <div class="card">
            <div class="card-header text-center">
                Reset Password
                <p class="mt-3">We have confirmed that it's you! Please enter your new password.</p>
            </div>
            <div class="card-body">
                <?php

                if ($_GET['email'] && $_GET['token']) {
                    // echo '<pre>';
                    // var_dump($_GET);
                    // echo '</pre>';


                    $email = $_GET['email'];
                    $token = $_GET['token'];
                    $query = mysqli_query(
                        $conn,
                        "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `u_email`='" . $email . "';"
                    );
                    $curDate = date("Y-m-d H:i:s");
                    if (mysqli_num_rows($query) > 0) {
                        $row = mysqli_fetch_array($query);
                        if ($row['token_expire'] >= $curDate) { ?>
                            <form action="update-forget-password.php" method="post">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="reset_link_token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name='password' class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" name='cpassword' class="form-control" required>
                                </div>
                                <button type="submit" name="new-password" class="btn btn-primary">Submit</button>
                            </form>
                        <?php }
                    } else { ?>
                        <p>This forget password link has been expired</p>
                <?php }
                }
                ?>
            </div>
        </div>
    </div>
    <footer>
        <?php include_once '../common/footer_module.php'; ?>
    </footer>
</body>

</html>