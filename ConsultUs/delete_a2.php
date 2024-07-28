<?php include('db_consultus_app.php') ?>
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
    header("location:".SITEURL.'appoint_consultant.php'."?user=$user");
}
else{
 $_SESSION['delete']= "<div  style='color:red;'> FAILED TO CANCEL APPOINTMENT </div>";         //creating session variable
 // redirecting page
 header("location:".SITEURL.'appoint_consultant.php?'."?user=$user");

}
?>