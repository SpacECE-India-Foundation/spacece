<?php
 //echo $_POST;
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
 $c_id=$_POST['c_id'];
// // encrypt pass 
$c_from_time=$_POST['c_from_time'];
$c_to_time=$_POST['c_to_time'];
 $time= date("H:i", strtotime($atime));
 $time1=strtotime($time);
 if(strtotime($c_from_time) > $time1 || strtotime($c_to_time) < $time1){
  echo 'Unavailable';

//  $_SESSION['add']= "Consultant Un available";
 }else{
   
  $sql1= " SELECT * from appointment WHERE `cid`='$c_id'";
  echo $sql1;
  $res1= mysqli_query($conn,$sql1);
  $row=mysqli_fetch_assoc($res1);
  if($row){

 
// //2.inserting into database
$sql= " UPDATE appointment SET  status ='$status',time_appointment='$atime',date_appointment='$adate' WHERE bid='$bookid'";

$res= mysqli_query($conn,$sql);


if($res){
  $sql1= " SELECT * from appointment WHERE `bid`='$bookid'";
 
  $res1= mysqli_query($conn,$sql1);
  $row=mysqli_fetch_assoc($res1);
    echo json_encode($row);
  

}
else{
    echo 'Invalid';

}


}else{
  echo 'Invalid';
}
 }

?>