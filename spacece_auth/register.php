<?php
session_start();
if (!isset($_SESSION['redirect_url']))
    $_SESSION['redirect_url'] = $_SERVER['HTTP_REFERER'];

if (isset($_SESSION['current_user_id'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Register</title>
</head>

<body>
    <div class="register-page">
        <h2>Register</h2>
        <form class="register-form" method="post" autocomplete="off">
            <input type="text" placeholder="Enter Name" id="name" name="name" />
            <input type="email" placeholder="Enter Email" id="email" name="email" />
            <input type="text" placeholder="Enter Mobile No." id="phone" name="phone" />
            <input type="password" placeholder="Enter Password" id="password" name="password" />
            <input type="password" placeholder="Confirm Password" id="cpassword" name="cpassword" />
            <input type="file" placeholder="Upload Image" id="image" name="image" />
            <select name="type" id="user_type">
                <option value="customer">Customer</option>
                <option value="consultant">Consultant</option>
            </select>
            <button type="submit" id="register" name="register">Register</button>
            <p class="message">Already registered? <a href="login.php">Login</a></p>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
</body>

</html>