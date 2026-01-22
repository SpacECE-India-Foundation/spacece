<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password – SpaceECE</title>
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
        .forgot-wrapper {
            display: flex;
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            margin: 20px 0;
        }

        /* LEFT – FORM */
        .forgot-box {
            flex: 1;
            padding: 40px 35px;
            animation: slideLeft 0.8s ease forwards;
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
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-size: 12px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #f6a609;
            box-shadow: 0 0 0 3px rgba(246,166,9,0.15);
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
            box-shadow: 0 8px 20px rgba(246,166,9,0.4);
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .hint {
            font-size: 12px;
            color: #888;
            margin-top: 12px;
        }

        .back {
            margin-top: 18px;
            font-size: 14px;
            text-align: center;
        }

        .back a {
            color: #f6a609;
            text-decoration: none;
            font-weight: 500;
        }


        /* Animations */
        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-25px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(25px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }

/* ===============================
   EXTRA SMALL DEVICES (≤360px)
================================ */
@media (max-width: 360px) {
    body {
        padding: 10px;
    }

    .forgot-box {
        padding: 25px 20px;
    }

    h2 {
        font-size: 20px;
    }

    p {
        font-size: 13px;
    }

    input {
        padding: 10px 12px;
        font-size: 13px;
    }

    .btn {
        font-size: 14px;
        padding: 12px;
    }
}

/* ===============================
   SMALL MOBILE (≤480px)
================================ */
@media (max-width: 480px) {
    body {
        padding: 15px;
    }

    .forgot-wrapper {
        border-radius: 14px;
        max-width: 100%;
    }
}

/* ===============================
   MOBILE / PHABLET (≤600px)
================================ */
@media (max-width: 600px) {
    .forgot-wrapper {
        flex-direction: column;
        max-width: 100%;
    }

    .forgot-box {
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

    .forgot-wrapper {
        max-width: 90%;
    }
}

/* ===============================
   SMALL LAPTOP (≤1024px)
================================ */
@media (max-width: 1024px) {
    .forgot-wrapper {
        max-width: 850px;
    }
}

/* ===============================
   DESKTOP (≥1200px)
================================ */
@media (min-width: 1200px) {
    .forgot-wrapper {
        max-width: 950px;
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
    .forgot-wrapper {
        max-width: 1100px;
    }

    .forgot-box {
        padding: 50px 45px;
    }

    h2 {
        font-size: 26px;
    }

    p {
        font-size: 16px;
    }

    input {
        padding: 14px 16px;
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
    .forgot-wrapper {
        max-width: 1250px;
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

<div class="forgot-wrapper">

    <!-- LEFT: FORM -->
    <div class="forgot-box">
        <div class="logo">
            <img src="../Assets/img/SpacECELogo.png" alt="SpaceECE">
        </div>

        <h2>Forgot Password</h2>
        <p>Please enter your registered email address or mobile number to proceed with password reset.</p>


        <form id="forgotForm">
            <div class="form-group">
                <label>Email or Mobile Number</label>
                <input type="text" id="login_id" placeholder="Email or Mobile Number" required>
            </div>

            <button type="submit" class="btn">Continue</button>
        </form>

        <div class="back">
            <a href="login.php">← Back to Login</a>
        </div>
    </div>
</div>


<script src="../Assets/js/auth.js"></script>

</body>
</html>
