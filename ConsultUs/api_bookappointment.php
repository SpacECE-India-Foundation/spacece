<?php
 include("indexDB.php");

 date_default_timezone_set("Asia/Kolkata");
$u_id=$_POST['u_id'];
$c_id=$_POST['c_id'];

//$b_time1=$_POST['b_time'];
$end_time=$_POST['end_time'];
 //$b_time= date($b_time1);
$b_date=date($_POST['b_date']);
$date3=strtotime(date("Y-m-d"));
$booking_time=$_POST['time'];
$date1=strtotime(date($b_date));
//$time=strtotime(date("H:i:s",date($_POST['time'])));
$time=strtotime(date($_POST['time']));
//$time=strtotime(date("H:i:s", strtotime($b_time1)));
//$date1= strtotime(date('2022-04-21 16:55:01'));;
//$date4 = strtotime(date(" H:i", strtotime('+ ' .$end_time. 'minutes', $booking_time)));
$date4 = date("H:i",strtotime('+ '.$end_time.'minutes', strtotime($booking_time)));
//$date4=strtotime($b_time,strtotime("+{ $end_time} minutes"));
$to_time1 = date("H:i:s",strtotime('+ '.$end_time.'minutes', strtotime($_POST['time'])));
function getWeekday($date) {
    return date('l', strtotime($date));
}

$avl= getWeekday($b_date);
   // $startTime = date("Y-m-d H:i:s", strtotime('+{ $end_time} minutes', $b_time));
$sql2="SELECT spaceece.consultant.c_from_time,spaceece.consultant.c_to_time,spaceece.consultant.c_aval_days As c_aval_days from spaceece.consultant join spaceece.users where  spaceece.users.u_id=spaceece.consultant.u_id AND spaceece.users.u_id='$c_id' ";
$res1 = mysqli_query($conn,$sql2);
$count= mysqli_num_rows($res1);
$sno =1;
if($count>0){
while($row = mysqli_fetch_assoc($res1)){
    $DaysArray = explode(",", $row['c_aval_days']);
    $to_time=strtotime($row['c_to_time']);
    $from_time=strtotime($row['c_from_time']);

    if (in_array($avl, $DaysArray))
  {

   
  
 if(  ( $time > $from_time ) &&  ( $time < $to_time ) ){

    if($date3 > $date1){
        echo json_encode(['status'=>'fail','b_time'=>$b_time,'date1'=>$date1,'date3'=>$date3,'msg'=>"INVALID SELECTED DATE"]);
        break;
    }else{
        
   // $b_date=date($_POST['b_date']);
    $sql1="SELECT * from new_apointment where b_date='$b_date' and  c_id='$c_id'  and booking_time BETWEEN '$booking_time' AND '$to_time1'   ";

    $res2 = mysqli_query($conn,$sql1);

           
            $count= mysqli_num_rows($res2);
            $sql2="SELECT * from new_apointment where b_date='$b_date' and  c_id='$c_id'  and end_time BETWEEN '$booking_time' AND '$to_time1'   ";

            $res3 = mysqli_query($conn,$sql2);
        
                   
                    $count2= mysqli_num_rows($res3);
            $sno =1;
          
            if($count>0 || $count2>0){
              
                echo json_encode(['status'=>'fail','msg'=>"CONSULTANT UN-AVAILABLE SELECTED Time"]);

            }else{
               
               $booking_id=rand(9999999,0000000);
        $sql = "INSERT INTO  new_apointment (booking_id,u_id,c_id,end_time,b_date,booking_time) VALUES('$booking_id','$u_id','$c_id','$to_time1','$b_date','$booking_time')";
                    $res = mysqli_query($conn,$sql);
                    header('Content-Type:application/json');
            
            
                    //checking whether query is excuted or not
                    if($res){
                        echo json_encode(['status'=>'success','b_date'=>$b_date,'Booking id'=> $booking_id , 'user_id'=>$u_id,'c_id'=>$c_id,'b_time'=> $b_time,'to_time'=>$to_time1,'b_date'=>$b_date,'booking_time'=>$booking_time, 'result'=>'Added']);
                        // count that data is there or not in database
                        
                    
                    }else{
                        echo json_encode(['status'=>'fail','msg'=>"CONSULTANT UN-AVAILABLE SELECTED Time"]);
                    }
    
    }


}
 }
else{


// if(((strtotime(date($row['c_from_time'])))> $date1) || ((strtotime(date($row['c_from_time'])))>$date4) ){
 
//     if(((strtotime(date($row['c_to_time'])))< $date1) || ((strtotime(date($row['c_to_time'])))< $date4 )){
//         echo json_encode(['status'=>'fail','b_time'=>$b_time,'date1'=>$date1,'date4'=>$date4, 'date3'=>$date3,'msg'=>"CONSULTANT NOT AVAILABLE"]);
//     }
    
//     }else{
    echo json_encode(['status'=>'fail','msg'=>"CONSULTANT NOT AVAILABLE"]);
       


}
}
else{
    echo json_encode(['status'=>'fail','msg'=>"CONSULTANT NOT AVAILABLE"]);
}
}



//}

} else{
    echo json_encode(['status'=>'fail','count'=>$count, 'msg'=>"UNABLE TO ADD DATA"]);
}  


    
                   
            ?>