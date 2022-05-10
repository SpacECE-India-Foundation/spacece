<?php //require "config/constants.php";
include '../../Db_Connection/db_libforsmall.php';
//include_once '../header_local.php';
include_once '../../common/header_module.php';
?>
<?php include "./templates/sidebar.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


</head>
<body>
    <!-- <a href="order_status.php">Order Status</a>
    <a href="myProducts.php">My Products</a>
    <a href="products.php">Add Products</a> -->

    

    <?php
   
    //var_dump($_SESSION['uid']);
    include_once '../../common/footer_module.php';
    ?>
</body>
</html>