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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <?= isset($extra_styles) ? $extra_styles : null ?>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .banner {
            width: 100%;
            height: 50vh;
            margin: 20px 0 50px;
        }


        .banner img {
            height: 100%;
            width: 100%;
        }

        body {
            color: #536482;
            background-color: white;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .about-page {
            display: flex;
            flex-direction: column;
        }

        .about-page .about-moto {
            display: flex;
            min-height: 320px;
            background-color: #f6f6f6;
            padding: 40px 80px;
            align-items: center;
            justify-content: center;
        }

        .about-page .about-desc {
            display: flex;
            flex-direction: column;
            padding: 40px 80px;
        }

        .about-page .about-desc h3 span {
            border-bottom: 2px solid #536482;
        }

        .about-page .about-desc p {
            margin-top: 20px;
            font-size: 20px;
            color: #707070;
            font-weight: 400;
            line-height: 1.5;
        }

        #js-pro-pic {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        #js-pro-pic img {
            height: 100px;
            width: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        .fileToUpload {
            opacity: 0;
            width: 17%;
            height: 4%;
            position: absolute;
            z-index: 999;
            cursor: pointer;
        }

        @media (max-width: 640px) {
            .fileToUpload {
                width: 41%;
                height: 3%;
            }
        }

        .file-input label {
            margin: 0 auto;
            display: block;
            width: 200px;
            height: 50px;
            border-radius: 25px;
            background-color: #FFA500;
            box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: transform .2s ease-out;
        }

        input:hover+label,
        input:focus+label {
            transform: scale(1.02);
        }

        input:focus+label {
            outline: 1px solid #000;
            outline: -webkit-focus-ring-color auto 2px;
        }

        .file-name {
            font-size: 1.2rem;
            color: #555;
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .fileToUpload {
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
          .navbar {
            display: flex;
            justify-content: start;
            align-items: center;
            background-color: #FFA500;
            padding: -10px;
            font-size: large;
        }

        .navbar .logo {
            display: flex;
            margin-left: 0px !important;
        }
        .main_nav{
          display: flex;
        }
          .user_avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .navbar div a span {
            margin-left: 0px !important;
        }

        .navbar .logo div a {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar .logo img {
          float: left;
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .navbar a {
           
            text-decoration: none;
            color: #000;
        }

        .dropbtn {
            background-color: #FFA500;
            color: #000;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            left: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }


        }


        @media only screen and (min-width: 600px) {
          .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #FFA500;
            padding: 10px;
            font-size: large;
        }

        .navbar .logo {
            display: flex;
        }
          .user_avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0px;
        }

        .navbar div a span {
            margin-left: 0px !important;
        }

        .navbar .logo div a {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .navbar .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .navbar a {
            margin-right: 20px;
            text-decoration: none;
            color: #000;
        }

        .dropbtn {
            background-color: #FFA500;
            color: #000;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            right: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        }


        @media only screen and (min-width: 768px) {
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
          .user_avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
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

        .dropbtn {
            background-color: #FFA500;
            color: #000;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            right: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        }


        @media only screen and (min-width: 992px) {
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
          .user_avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .main_nav{
          justify-content: center;
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
            justify-content: center;
        }
        .dropbtn {
            background-color: #FFA500;
            color: #000;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            right: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        }

        @media only screen and (min-width: 1200px) {
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
          .user_avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
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

        .dropbtn {
            background-color: #FFA500;
            color: #000;
            padding: 16px;
            font-size: 16px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            right: 10px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        }


    </style>
    <!-- BUG ID-0000067 -->
    <title><?= isset($module_name) ? $module_name : 'SpaceECE' ?></title>
</head>

<body>
    <?php $main_page = isset($main_page) ? ($main_page) :  NULL ?>

    <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="logo">
            <div class="org_logo">
                <a href=<?= $main_page ? "./index.php" : "../index.php" ?>>
                    <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" alt="Spacece">
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <div class="main_nav nav">
        <ul class=" nav navbar-nav ">
        <li class="nav-item">
            <a href="./index.php"><i class="fa fa-home" aria-hidden="true"></i><span>Home</span></a></li>
            <?= isset($extra_main_nav_links) ? $extra_main_nav_links : null ?>
            <li class="nav-item"> <a href="./about.php"><i class="fas fa-address-card"></i><span>About</span></a></li>
        </div>
        <div class="user">
            <?php
            if (isset($_SESSION['current_user_id'])) {
            ?>
                <div class="dropdown p-5">
                    <button class="dropbtn">
                        <img class="user_avatar " src=<?= !isset($_SESSION['current_user_image']) ? 'https://www.w3schools.com/howto/img_avatar.png' : ($main_page ? './img/users/' . $_SESSION['current_user_image'] : '../img/users/' . $_SESSION['current_user_image']) ?> alt="User" />
                        <span style="cursor: pointer;">Hi, <?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : 'Guest' ?></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="<?= isset($main_page) ? "./spacece_auth/profile.php" : "../spacece_auth/profile.php" ?>"><i class="fas fa-user"></i><span>Profile</span></a>
                        <?= isset($extra_profile_links) ? $extra_profile_links : null ?>
                        <a href=<?= isset($main_page) ? "./spacece_auth/logout.php" : "../spacece_auth/logout.php" ?>><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <a href=<?= isset($main_page) ? "./spacece_auth/register.php" : "../spacece_auth/register.php" ?>>
                    <i class="fas fa-user-plus"></i><span>Register</span></a>
                <a href=<?= isset($main_page) ? "./spacece_auth/login.php" : "../spacece_auth/login.php" ?>>
                    <i class="fas fa-sign-in-alt"></i><span>Login</span></a>
            <?php
            }
            ?>
        </div>
    </div>
    </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</body>
<html>