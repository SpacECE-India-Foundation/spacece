<?php
 //echo $_POST;
include("../Db_Connection/indexDB.php");

 $full_name = $_POST['fullname'];
 $email = $_POST['email'];
 $mob =  $_POST['mobile'];
 $bookid =  $_POST['b_id'];
  $atime = $_POST["atime"];
  $adate = $_POST["adate"];
 $status ="inactive";
 $c_id=$_POST['c_id'];
// // encrypt pass 
 $valid=false;
$c_from_time=$_POST['c_from_time'];
$c_to_time=$_POST['c_to_time'];
$getDate=date($adate);
 $time= date("H:i:s", strtotime($atime));
 $time1=strtotime($time);
 if(strtotime($c_from_time) > $time1 || strtotime($c_to_time) < $time1){
  echo 'Unavailable';

//  $_SESSION['add']= "Consultant Un available";
 }else{
 // echo "Inside";
   $time3 = strtotime(date($atime));
//$startTime = date("H:i:s", strtotime('-10 minutes', $time3));
 $endTime1 = strtotime("+10 minutes", strtotime( $atime));
 $endTime =date('H:i:s',$endTime1);


  $sql2= "SELECT time_appointment from appointment WHERE `cid`='$c_id' and date_appointment='$adate'";

 $res2= mysqli_query($conn,$sql2);
 $row2=mysqli_fetch_assoc($res2);

 if($row2){
  while( $row=mysqli_fetch_assoc($res2)){
    $booked_time=$row['time_appointment'];
  
  
 $sql4="SELECT * from appointment WHERE `cid`='$c_id' and date_appointment='$adate' and time_appointment BETWEEN '$booked_time' AND '$endTime'";

 
 $res4= mysqli_query($conn,$sql4);
 $row4=mysqli_fetch_assoc($res4);
if($row4){
  $valid=true;
      
}

       // if(($booked_time < $time3) || ($booked_time < $endTime)){
       
        
    else{
      $sql= " UPDATE appointment SET  status ='$status',time_appointment='$atime',date_appointment='$adate' WHERE bid='$bookid'";

      $res= mysqli_query($conn,$sql);
      
      
          if($res){
            $sql1= " SELECT * from appointment WHERE `bid`='$bookid'";
          
            $res1= mysqli_query($conn,$sql1);
            $row=mysqli_fetch_assoc($res1);
              echo json_encode($row);
            
      
          }

    }
      

    
  }
}else{
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
      }
    }
    if($valid){
      echo "Invalid";

    }

?>
