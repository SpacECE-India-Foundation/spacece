<?php
include 'indexdb.php';

var_dump($_POST);
// $full_name = $user_name;
// $email = $user_email;
// $mob = $user_mob;
// // $bookid = $uid;
//  $atime = $_POST["atime"];
//  $adate = $_POST["adate"];
// $status ="inactive";
// // encrypt pass 
// $time= date("H:i", strtotime($atime));
// $time1=strtotime($time);
// if(strtotime($c_from_time) > $time1 || strtotime($c_to_time) < $time1){
//  echo '<script>alert("Consultant Un available in selected Time");<script>';

//  $_SESSION['add']= "Consultant Un available";
// }else{


// //2.inserting into database
// $sql= " UPDATE `appointment` SET  `status`='$status',`time_appointment`='$atime',`date_appointment`='$adate' WHERE `bid`='$b_id'";

// $res= mysqli_query($conn,$sql);
// echo "<h3 style = 'color:white;'>$full_name<h3>";
// echo "<h3 style = 'color:white;'>$email<h3>";
// echo "<h3 style = 'color:white;'>$mob<h3>";
// echo "<h3 style = 'color:white;'>$userid<h3>";

// //3. checking data is inserted or not
// if($res){
//    $_SESSION['add']= "<div style='color:green;'> appointment booked successfully</div>";         //creating session variable
//    // redirecting page
//    header("location:./alldoc.php");
//    //echo "<h3 style = 'color:white;'>database updated<h3>";
// }
// else{
// $_SESSION['add']= "failed to book appointment successfully";         //creating session variable
// // redirecting page
// header("location:./alldoc.php");
// //echo "<h3 style = 'color:white;'>database not updated<h3>";
// }


//}


?>