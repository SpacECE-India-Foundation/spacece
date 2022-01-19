<?php include('indexDB.php') ?>
<?php $nid=$_GET['id'];
 $user=$_GET['user'];
 ?>

<?php

//.create sql query to delete valye
$sql= "DELETE FROM `appointment` WHERE `appointment`.`bid` = $nid";
//excetuting query
$res = mysqli_query($conn,$sql);
if($res){
    $_SESSION['delete']= "<div style='color:green;'> APPOINTMENT CANCELLED SUCCESSFULLY</div>";         //creating session variable
    // redirecting page
    $page = $_SERVER['PHP_SELF'];
    $sec = "10";
    header("Location:showmyappointment.php");
}
else{
 $_SESSION['delete']= "<div  style='color:red;'> FAILED TO CANCEL APPOINTMENT </div>";         //creating session variable
 // redirecting page
 header("location:/cdetails.php?category=all");

}
?>