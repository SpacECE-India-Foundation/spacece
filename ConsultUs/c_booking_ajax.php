<?php

$servername = "3.109.14.4";
$username = "ostechnix";
$password = "Password123#@!";
$dbname = "consultant_app";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//var_dump($_POST);
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
  echo 'Consultant is UN Available in SELECTED Time';

//  $_SESSION['add']= "Consultant Un available";
 }else{

    $sql1= " SELECT * from appointment WHERE `bid`='$bookid'";
 
    $res1= mysqli_query($conn,$sql1);
    
    

// //2.inserting into database
$sql= " UPDATE appointment SET  status ='$status',time_appointment='$atime',date_appointment='$adate' WHERE bid='$bookid'";

$res= mysqli_query($conn,$sql);


if($res){
   echo '<div>Successfully Booked With
       <h5>Booking Id: '.$bookid.'</h5>
       <h5>Full name: '.$full_name.'</h5>
       <h5>Email: '.$email.'</h5>
       <h5>Phone Number: '.$mob.'</h5>
       </div>';


}
else{
    echo 'Invalid Data';

}


}


?>