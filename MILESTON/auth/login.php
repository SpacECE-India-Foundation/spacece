<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login – SpaceECE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector('.animate-left').style.animationDelay = "0.2s";
    document.querySelector('.animate-right').style.animationDelay = "0.4s";
});
</script>
<link rel="stylesheet" href="../Assets/css/auth.css">
</head>
<body>

<div class="login-wrapper animate-container">

    <!-- LEFT SIDE -->
    <div class="login-box animate-left">
        <div class="logo">
            <img src="../Assets/img/SpacECELogo.png" alt="SpaceECE">
        </div>

        <h2>Welcome Back</h2>
        <p>Login to track your child’s milestones</p>

        <form id="loginForm">

            <div class="form-group">
                <label>Email or Mobile Number</label>
                <input type="text" id="email" placeholder="Email or Mobile Number" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" placeholder="Password" required>
            </div>

            <div class="forgot">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <div class="signup">
            Don’t have an account?
            <a href="../auth/signup.php">Create New Account</a>
        </div>
    </div>

</div>


<script src="../Assets/js/login.js"></script>
</body>
</html>
