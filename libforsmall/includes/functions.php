<?php
session_start();
include '../../Db_Connection/db_spacece.php';
if(isset($_POST['get'])){
  $product=$_POST['product'];
  $result1="";
    $query = mysqli_query($mysqli," SELECT * FROM package where product= '$product' " )
    or die('Sql Query4 Error' . mysqli_error($mysqli));
while ($result = mysqli_fetch_assoc($query)) {
    echo '<div class="row">
   <div class="col"><h4>'.$result["pack_name"].'</h4></div>
   <div class="row"><div class="col col-sm-3">'.$result['price'].'</div> <div class="col col-sm-3">'.$result['num_days'].'</div> 
    <div class="col col-sm-3"><input type="submit" id="buy" class="btn btn-primary buy1" data-id='.$result['pack_id'].' value="Buy Now"></div></div><hr>';
  
}

}
if(isset($_POST['dates'])){
    $u_id= $_SESSION['u_id'];
    $query = mysqli_query($mysqli,"  SELECT * FROM users JOIN package WHERE users.u_id='$u_id'" )
    or die('Sql Query4 Error' . mysqli_error($mysqli));
    $result=mysqli_fetch_assoc($query);
    if(mysqli_num_rows($query)>0){
       // $result=mysqli_fetch_assoc($query);
     //var_dump($result);
        $p_date=$result['date_of_purchase'];
        $total_days=$result['num_days'];
        $now = time();
        //echo $p_date;
$your_date = strtotime($p_date);
$datediff = $now - $your_date;

 $diff=round($datediff / (60 * 60 * 24));
 //echo $diff;
$avl=$total_days-$diff;
echo $avl;

    }
   


   
}
