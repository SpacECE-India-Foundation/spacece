<?php
include 'indexdb.php';

var_dump($_POST);
 $full_name = $_POST['fullname'];
 $email = $_POST['email'];
 $mob =  $_POST['mobile'];
 $bookid =  $_POST['b_id'];
  $atime = $_POST["atime"];
  $adate = $_POST["adate"];
 $status ="inactive";
// // encrypt pass 
$c_from_time=$_POST['c_from_time'];
$c_to_time=$_POST['c_to_time'];
 $time= date("H:i", strtotime($atime));
 $time1=strtotime($time);
 if(strtotime($c_from_time) > $time1 || strtotime($c_to_time) < $time1){
  echo 'Error';

//  $_SESSION['add']= "Consultant Un available";
 }else{


// //2.inserting into database
$sql= " UPDATE `appointment` SET  `status`='$status',`time_appointment`='$atime',`date_appointment`='$adate' WHERE `bid`='$b_id'";
echo $sql;
$res= mysqli_query($conn,$sql);
echo $res;
// echo "<h3 style = 'color:white;'>$full_name<h3>";
// echo "<h3 style = 'color:white;'>$email$email<h3>";
// echo "<h3 style = 'color:white;'>$mob<h3>";
// echo "<h3 style = 'color:white;'>$userid<h3>";

//3. checking data is inserted or not
if($res){
   echo "success".$full_name.$email.$mob;
//    $_SESSION['add']= "<div style='color:green;'> appointment booked successfully</div>";         //creating session variable
   // redirecting page
//    header("location:./alldoc.php");
   //echo "<h3 style = 'color:white;'>database updated<h3>";
}
else{
    echo 'Error1';
//$_SESSION['add']= "failed to book appointment ";         //creating session variable
// redirecting page
// header("location:./alldoc.php");
//echo "<h3 style = 'color:white;'>database not updated<h3>";
}


}


?>