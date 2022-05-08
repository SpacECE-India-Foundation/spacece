<?php
include '../../Db_Connection/db_libforsmall.php';

include_once '../header_local.php';
include_once '../../common/header_module.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row">
    <?php
   $uid= $_SESSION['uid'];
$sql = "SELECT * from products where user_id='$uid'";
$res = $conn->query($sql);
if($res){
    while($row=mysqli_fetch_assoc($res)){
?>

<div class="col-sm-3">
<div class="card d-flex justify-content-center">
    <div class="card-body">
        <img src="../product_images/<?php echo $row['product_image'];?>" class="img img-responsive w-50">
        <div>
            <h4>Title : <?php echo $row['product_title'];?></h4>
            <div >Available :<?php echo $row['product_qty'];?></div>
        
        <h5>Price : <?php echo $row['product_price'];?> /-</h5>
        </div>
    </div>
</div>
</div>
    
<?php
    }
}else{
    echo "No data found";
}


?>
</div>


</div>
</body>
</html>