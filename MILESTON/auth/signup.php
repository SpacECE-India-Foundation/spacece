<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parent Signup – SpaceECE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            background: linear-gradient(180deg, #fdf3e2, #ffd6a5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Layout */
        .signup-wrapper {
            display: flex;
            max-width: 1050px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            margin: 20px 0;
        }

        /* LEFT – FORM */
        .signup-box {
            flex: 1;
            padding: 40px 35px;
            animation: slideLeft 1s ease forwards;
        }

        .logo img {
            width: 90px;
        }

        h2 {
            font-size: 22px;
            color: #333;
            margin: 10px 0 6px;
        }

        p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 14px;
            position: relative;
        }

        label {
            font-size: 11px;
            color: #333;
            display: block;
            margin-bottom: 4px;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #f6a609;
            box-shadow: 0 0 0 3px rgba(246,166,9,0.15);
        }

        .password-hint {
            font-size: 11px;
            color: #888;
            margin-top: 4px;
            display: block;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: #f6a609;
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
            box-shadow: 0 8px 20px rgba(246,166,9,0.4);
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Trust Points */
        .signup-benefits {
            list-style: none;
            margin-top: 16px;
            padding: 0;
            font-size: 12px;
            color: #555;
        }

        .signup-benefits li {
            margin-bottom: 5px;
        }

        /* Terms */
        .terms {
            font-size: 11px;
            color: #888;
            margin-top: 14px;
            text-align: center;
        }

        .terms a {
            color: #f6a609;
            text-decoration: none;
        }

        .login-link {
            margin-top: 14px;
            font-size: 14px;
            text-align: center;
        }

        .login-link a {
            color: #f6a609;
            text-decoration: none;
            font-weight: 500;
        }

        /* Animations */
        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(30px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
            100% { transform: translateY(0); }
        }

        /* ===============================
   EXTRA SMALL DEVICES (≤360px)
================================ */
@media (max-width: 360px) {
    body {
        padding: 10px;
    }

    .signup-box {
        padding: 25px 20px;
    }

    h2 {
        font-size: 20px;
    }

    p {
        font-size: 13px;
    }

    input {
        padding: 9px 11px;
        font-size: 13px;
    }

    .btn {
        font-size: 14px;
        padding: 12px;
    }

    .signup-benefits {
        font-size: 11px;
    }
}

/* ===============================
   SMALL MOBILE (≤480px)
================================ */
@media (max-width: 480px) {
    body {
        padding: 15px;
    }

    .signup-wrapper {
        border-radius: 14px;
        max-width: 100%;
    }

    .password-hint,
    .terms {
        font-size: 10px;
    }
}

/* ===============================
   MOBILE / PHABLET (≤600px)
================================ */
@media (max-width: 600px) {
    .signup-wrapper {
        flex-direction: column;
        max-width: 100%;
    }

    .signup-box {
        padding: 35px 25px;
    }
}

/* ===============================
   TABLET (≤768px)
================================ */
@media (max-width: 768px) {
    body {
        padding: 20px;
    }

    .signup-wrapper {
        max-width: 92%;
    }
}

/* ===============================
   SMALL LAPTOP (≤1024px)
================================ */
@media (max-width: 1024px) {
    .signup-wrapper {
        max-width: 950px;
    }
}

/* ===============================
   DESKTOP (≥1200px)
================================ */
@media (min-width: 1200px) {
    .signup-wrapper {
        max-width: 1100px;
    }

    h2 {
        font-size: 24px;
    }

    p {
        font-size: 15px;
    }
}

/* ===============================
   EXTRA LARGE / 2XL (≥1440px)
================================ */
@media (min-width: 1440px) {
    .signup-wrapper {
        max-width: 1250px;
    }

    .signup-box {
        padding: 50px 45px;
    }

    h2 {
        font-size: 26px;
    }

    p {
        font-size: 16px;
    }

    input {
        padding: 13px 15px;
        font-size: 15px;
    }

    .btn {
        font-size: 16px;
        padding: 14px;
    }
}

/* ===============================
   ULTRA WIDE / 4K (≥1800px)
================================ */
@media (min-width: 1800px) {
    .signup-wrapper {
        max-width: 1450px;
    }

    h2 {
        font-size: 28px;
    }

    p {
        font-size: 17px;
    }
}

    </style>
</head>
<body>

<div class="signup-wrapper">

    <!-- LEFT: FORM -->
    <div class="signup-box">
        <div class="logo">
            <img src="../Assets/img/SpacECELogo.png" alt="SpaceECE">
        </div>

        <h2>Create Parent Account</h2>
        <p>Start tracking your child’s milestones</p>

        <form id="signupForm">
    <input type="hidden" id="type" value="parent">

    <div class="form-group">
        <label>Parent Full Name</label>
        <input type="text" id="name" required>
    </div>

    <div class="form-group">
        <label>Email Address</label>
        <input type="email" id="email" required>
    </div>

    <div class="form-group">
        <label>Mobile Number</label>
        <input type="tel" id="phone" pattern="[0-9]{10}" required>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" id="password" required>
    </div>

    <button type="submit" class="btn">Create Account</button>

    <!-- 👇 MESSAGE WILL SHOW HERE -->
    <p id="formMessage" style="margin-top:10px;text-align:center;"></p>
</form>


        <ul class="signup-benefits">
            <li>✔ Track child milestones easily</li>
            <li>✔ Secure & private data</li>
            <li>✔ Expert-backed insights</li>
        </ul>

        <p class="terms">
            By creating an account, you agree to our
            <a href="#">Terms</a> & <a href="#">Privacy Policy</a>
        </p>

        <div class="login-link">
            Already have an account?
            <a href="login.php">Login</a>
        </div>
    </div>

</div>

<script src="../Assets/js/singup.js"></script>

</body>
</html>
