<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?= isset($extra_styles) ? $extra_styles : null ?>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            padding: 20px 25px;
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

        .dropbtn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border: none;
            background: none;
            padding: 0;
            margin: 0;
            line-height: 1;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            /* Position directly below the button */
            right: 0;
            /* Align to the right edge of the parent */
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            border-radius: 4px;
            padding: 8px 0;
        }

        .dropdown-content a {
            color: #000;
            padding: 10px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .dropbtn:focus {
            outline: none;
        }

        .dropdown-content a:hover {
            background-color: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .user_avatar {
            width: 32px;
            /* Consistent size */
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
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
            color: rgb(0, 0, 0);
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
            margin-top: 25px;
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

        .icon-hover:hover {
            color: orange;
        }
    </style>
    <!-- BUG ID-0000067 -->
    <title><?= isset($module_name) ? $module_name : 'SpaceECE' ?></title>
</head>

<body>
    <?php $main_page = isset($main_page) ? ($main_page) :  NULL ?>

    <nav class="navbar fixed-top">
        <div class="logo">
            <div class="org_logo">
                <a href=<?= $main_page ? "./index.php" : "../index.php" ?>>
                    <img src="<?= isset($main_logo) ? $main_logo : '#' ?>" alt="Spacece">
                    <span>Spaces Web Portal</span>
                    <!-- <span style="<?php $main_page ? '' : 'text-align: center;'; ?>">
                    SpaceECE Web Portal
                </span> -->

                </a>
            </div>
            <?php
            if (isset($module_name)) {
            ?>
                <div class="module_logo" style="margin-top: 15px; margin-left:620px;">
                    <a href="./index.php">
                        <span style="position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);color: #ffb300;font-weight: 700;">
                            <?= isset($module_name) ? $module_name : 'Spacece' ?>
                        </span>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="user">
            <?php
            if (isset($_SESSION['current_user_id'])) {
            ?>
                <div class="dropdown">
                    <button class="dropbtn">

                        <?php
                        if (isset($main_page)) {
                            $img_path = "./img/users/";
                        } elseif (isset($sub_page)) {
                            $img_path = "../../img/users/";
                        } else {
                            $img_path = "../img/users/";
                        }
                        ?>
                        <img class="user_avatar"
                            src="<?= !isset($_SESSION['current_user_image'])
                                        ? 'https://www.w3schools.com/howto/img_avatar.png'
                                        : $img_path . $_SESSION['current_user_image'] ?>"
                            alt="User" />

                        <span style="cursor: pointer;"><?= isset($_SESSION['current_user_name']) ? $_SESSION['current_user_name'] : 'Guest' ?></span>
                    </button>
                    <?php
                    if (isset($main_page)) {
                        $auth_path = "./spacece_auth/";
                    } elseif (isset($sub_page)) {
                        $auth_path = "../../spacece_auth/";
                    } else {

                        $auth_path = "../spacece_auth/";
                    }
                    ?>

                    <div class="dropdown-content">
                        <a href="<?= $auth_path ?>profile.php">
                            <i class="fas fa-user"></i><span>Profile</span>
                        </a>

                        <?= isset($extra_profile_links) ? $extra_profile_links : null ?>

                        <a href="<?= $auth_path ?>logout.php">
                            <i class="fas fa-sign-out-alt"></i><span>Logout</span>
                        </a>
                    </div>


                </div>
            <?php
            } else {
            ?>
                <div class="main_nav">
                    <!-- <a href="../index.php"><i class="fa-solid fa-house"></i></a> -->
                    <a href="<?= isset($main_page) ? "index.php" : "../index.php" ?>"><i class="fa-solid fa-house icon-hover"></i></a>
                    <?= isset($extra_main_nav_links) ? $extra_main_nav_links : null ?>
                    <a href="./about.php"><i class="fa-solid fa-circle-info icon-hover"></i></a>
                    <!-- <a href="./spacece_auth/login.php"><i class="fa-regular fa-circle-user"></i></a> -->
                    <a href="<?= isset($main_page) ? "./spacece_auth/login.php" : "../spacece_auth/login.php" ?>"><i class="fa-regular fa-circle-user icon-hover"></i></a>

                </div>
            <?php
            }
            ?>
        </div>
    </nav>
</body>
<html>