<?php //require "config/constants.php";
include '../../Db_Connection/db_libforsmall.php';
//include_once '../header_local.php';
include_once '../../common/header_module.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="order_status.php">Order Status</a>
    <a href="myProducts.php">My Products</a>
    <a href="products.php">Add Products</a>

    

    <?php
   
    var_dump($_SESSION['uid']);
    ?>
</body>
</html>