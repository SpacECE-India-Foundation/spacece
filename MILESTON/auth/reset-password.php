<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password – SpaceECE</title>
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
        .reset-wrapper {
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
        .reset-box {
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
            margin-bottom: 16px;
            position: relative;
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

    .reset-box {
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

    .reset-wrapper {
        border-radius: 14px;
        max-width: 100%;
    }

    .password-hint {
        font-size: 10px;
    }
}

/* ===============================
   MOBILE / PHABLET (≤600px)
================================ */
@media (max-width: 600px) {
    .reset-wrapper {
        flex-direction: column;
        max-width: 100%;
    }

    .reset-box {
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

    .reset-wrapper {
        max-width: 90%;
    }
}

/* ===============================
   SMALL LAPTOP (≤1024px)
================================ */
@media (max-width: 1024px) {
    .reset-wrapper {
        max-width: 850px;
    }
}

/* ===============================
   DESKTOP (≥1200px)
================================ */
@media (min-width: 1200px) {
    .reset-wrapper {
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
    .reset-wrapper {
        max-width: 1100px;
    }

    .reset-box {
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
    .reset-wrapper {
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

<div class="reset-wrapper">

    <!-- LEFT: FORM -->
    <div class="reset-box">
        <div class="logo">
            <img src="../Assets/img/SpacECELogo.png" alt="SpaceECE">
        </div>

        <h2>Reset Password</h2>
        <p>Create a new password for your account.</p>

            <form id="resetForm">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" id="new_password" required>
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" id="confirm_password" required>
                </div>

                <button type="submit" class="btn">Reset Password</button>
            </form>

        <div class="back">
            <a href="login.php">← Back to Login</a>
        </div>
    </div>


</div>


<script src="../Assets/js/auth.js"></script>
</body>
</html>
