<?php
include('../../Db_Connection/db_learnonapp.php');
include_once('includes/header.php');
//session_start();
if(isset($_SESSION['u_id'])){
   // echo"Hello";

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>LearnOn</title>
</head>

<body>
    <div class="">
        <div class="header">
            <div class="logo">
                <a href="./index.php">LearnOn</a>
            </div>
            <div class="menu_wrapper">
                <ul>
                    <li>
                        <a href="..index.php">Home</a>
                    </li>
                    <li>
                        <a href="./courses">Courses</a>
                    </li>
                    <li>
                        <a href="#">About Us</a>
                    </li>
                </ul>
            </div>
            <div class="auth_wrapper">
                <ul>
                    <li>
                        <?php
                        if(isset($_SESSION['u_id'])){
                             $url = BASE_URL; 
                              ?>
                                <a href='./logout.php'>Logout</a>
                                <?php
                            }else{
                                ?>
                                <a href='./login.php'>Login</a>
                           <?php
                            }
                        ?>

                     
                    </li>
                    <li>
                        <a href="<?= BASE_URL; ?>register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>