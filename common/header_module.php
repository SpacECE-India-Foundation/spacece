<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFA500;
            padding: 20px;
            font-size: large;
        }

        .navbar .logo {
            display: flex;
        }

        .navbar div a span {
            margin-left: 10px;
        }

        .navbar .logo div a {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar .logo img {
            width: 75px;
            height: 75px;
            border-radius: 50%;
        }

        .navbar a {
            margin-right: 20px;
            text-decoration: none;
            color: #000;
        }
    </style>
    <title><?= isset($module_name) ? $module_name : 'Spacece' ?></title>
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <div class="org_logo">
                <a href="../index.php">
                    <img src="https://spacefoundation.in/test/SpacECE-1710/img/logo/SpacECELogo.jpg" alt="Spacece">
                    <span>SpaceECE</span>
                </a>
            </div>
            <?php
            if (isset($module_name)) {
            ?>
                <div class="module_logo">
                    <a href="./index.php">
                        <img src="<?= isset($module_logo) ? $module_logo : 'Spacece' ?>" alt="Module">
                        <span><?= isset($module_name) ? $module_name : 'Spacece' ?><span>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="main_nav">
            <a href="./index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a>
            <a href="./about.php"><i class="fas fa-address-card"></i><span>About</span></a>
        </div>
        <div class="user">
            <?php
            if (isset($_SESSION['current_user_id'])) {
            ?>
                <a href="./profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
                <a href="../spacece_auth/logout.php"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
            <?php
            } else {
            ?>
                <a href="../spacece_auth/login.php"><i class="fas fa-user-plus"></i><span>Register</span></a>
                <a href="../spacece_auth/register.php"><i class="fas fa-sign-in-alt"></i><span>Login</span></a>
            <?php
            }
            ?>
        </div>
    </nav>