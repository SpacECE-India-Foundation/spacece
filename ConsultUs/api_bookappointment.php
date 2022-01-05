<?php
 include("indexDB.php");

 date_default_timezone_set("Asia/Kolkata");
$u_id=$_POST['u_id'];
$c_id=$_POST['c_id'];

$b_time1=$_POST['b_time'];
$end_time=$_POST['end_time'];
 $b_time= date($b_time1);
$b_date=date($_POST['b_date']);
$date3=strtotime(date("Y-m-d"));
$booking_time=$_POST['time'];
$date1=strtotime(date($b_date));
//$time=strtotime(date("H:i:s",date($_POST['time'])));
$time=strtotime(date("H:i:s",date($_POST['time'])));
//$time=strtotime(date("H:i:s", strtotime($b_time1)));
//$date1= strtotime(date('2022-04-21 16:55:01'));;
$date4 = strtotime(date(" H:i", strtotime('+ ' .$end_time. 'minutes', $booking_time)));
//$date4=strtotime($b_time,strtotime("+{ $end_time} minutes"));

   // $startTime = date("Y-m-d H:i:s", strtotime('+{ $end_time} minutes', $b_time));
$sql2="SELECT spaceece.consultant.c_from_time,spaceece.consultant.c_to_time from spaceece.consultant join spaceece.users where  spaceece.users.u_id=spaceece.consultant.u_id AND spaceece.users.u_id='$c_id' ";
$res1 = mysqli_query($conn,$sql2);
$count= mysqli_num_rows($res1);
$sno =1;
if($count>0){
while($row = mysqli_fetch_assoc($res1)){

    $to_time=strtotime(date( "h:i:s",$row['c_to_time']));
    $from_time=strtotime(date( "h:i:s",$row['c_from_time']));

 if(  ( $time > $from_time ) &&  ( $time < $to_time ) ){

    if($date3 > $date1){
        echo json_encode(['status'=>'fail','b_time'=>$b_time,'date1'=>$date1,'date3'=>$date3,'msg'=>"INVALID SELECTED DATE"]);
        break;
    }else{

   // $b_date=date($_POST['b_date']);
    $sql1="SELECT * from new_apointment where c_id='$c_id' and b_date='$b_date'";
    
    $res2 = mysqli_query($conn,$sql1);

            // count that data is there or not in database
            $count= mysqli_num_rows($res2);
            $sno =1;
            if($count>0){
                while($row = mysqli_fetch_assoc($res2)){
                $date5=strtotime($row['booking_time']);
           
                $tme=$row['b_time'];
                $end=$row['end_time'];
          
                $date2=strtotime($row['booking_time'] ,strtotime("+{ $end} minutes") );
               
                $endTime1 = date("H:i",strtotime('+ '.$end.'minutes', strtotime($row['booking_time'])));

                        $endTime=strtotime($endTime1);
                if(($time > $date5) || ($time > $endTime) ){
        
                
                 
                    //   && ($time > $endTime)  || (($time < $date5) && ($time < $endTime)  if ($date1 > $date2 ||  $date1 < $date2 ){
                        
                            $sql = "INSERT INTO  new_apointment (u_id,c_id,end_time,b_date,booking_time) VALUES('$u_id','$c_id','$end_time','$b_date','$booking_time')";
                      
                            $res = mysqli_query($conn,$sql);
                            header('Content-Type:application/json');
                    
                    
                            //checking whether query is excuted or not
                            if($res){
                                echo json_encode(['status'=>'success','time'=>$time,'row'=>$endTime,'date5'=>$date5,'b_time'=>$date2,'date1'=>$date1,'date3'=>$date3,'date4'=>$date4,'result'=>'Added']);
                                // count that data is there or not in database
                                
                            break;
                            }
                        
                        
                    
                }
                else{
                        echo json_encode(['status'=>'fail2','time'=>$time,'row'=>$endTime,'b_time'=>$row['booking_time'],'date1'=>$date5,'date3'=>$date3,'date2'=>$endTime,'msg'=>"UNABLE TO ADD DATA"]);
                        break;

                    }
                    
                    
                    
                }

            

            }else{


        $sql = "INSERT INTO  new_apointment (u_id,c_id,b_time,end_time,b_date,booking_time) VALUES('$u_id','$c_id','$b_time','$end_time','$b_date','$booking_time')";
                    $res = mysqli_query($conn,$sql);
                    header('Content-Type:application/json');
            
            
                    //checking whether query is excuted or not
                    if($res){
                        echo json_encode(['status'=>'success','result'=>'Added']);
                        // count that data is there or not in database
                        
                    
                    }else{
                        echo json_encode(['status'=>'fail','b_date'=>$b_date, 'msg'=>"UNABLE TO ADD DATA"]);
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


//}

} else{
    echo json_encode(['status'=>'fail','count'=>$count, 'msg'=>"UNABLE TO ADD DATA"]);
}  


    
                   
            ?>