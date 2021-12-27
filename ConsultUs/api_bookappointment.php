<?php
 include("indexDB.php");


$u_id=$_POST['u_id'];
$c_id=$_POST['c_id'];

$b_time=$_POST['b_time'];
$end_time=$_POST['end_time'];
date($b_time);
$date3=strtotime(date("Y-m-d h:i:sa"));
date_default_timezone_set("Asia/Kolkata");
$date1=strtotime(date($b_time));

if($date3 < $date1){
    echo json_encode(['status'=>'fail','date1'=>$date1,'date3'=>$date3,'msg'=>"INVALID SELECTED DATE"]);
    
}else{

  
$sql1="SELECT * from new_apointment where c_id='$c_id'";
$res = mysqli_query($conn,$sql1);
{
    if($res){
        // count that data is there or not in database
        $count= mysqli_num_rows($res);
        $sno =1;
        if($count>0){
            while($row = mysqli_fetch_assoc($res)){

          
            $tme=$row['b_time'];
            $end=$row['end_time'];
          
            $date2=strtotime($row['b_time']);
            echo  $date2;
            echo "INisde";
            echo $date1;
            if($date1>$date2 || $date1<$date2){
                echo json_encode(['status'=>'fail','time'=>$date3, 'time2'=>$date2,'msg'=>"UNABLE TO ADD DATA"]);
               
                // if(strtotime($row['b_time'],strtotime("+{ $end} minutes")   )> $date1 || strtotime($row['b_time'],strtotime("+{ $end} minutes")    )< $date1 ){
                //     $sql = "INSERT INTO  new_apointment (u_id,c_id,b_time,end_time) VALUES('$u_id','$c_id','$b_time','$end_time')";
                //     $res = mysqli_query($conn,$sql);
                //     header('Content-Type:application/json');
            
            
                //     //checking whether query is excuted or not
                //     if($res){
                //         echo json_encode(['status'=>'success','result'=>'found']);
                //         // count that data is there or not in database
                        
                       
                //     }
                  
                //    }else{
                //     echo json_encode(['status'=>'fail','time'=>$date3, 'time2'=>$date2,'msg'=>"UNABLE TO ADD DATA"]);
                //    }
            }else{
                echo json_encode(['status'=>'fail','time'=>$date3, 'time2'=>$date2,'msg'=>"UNABLE TO ADD DATA"]);
            }

          

        }
    }else{
        $sql = "INSERT INTO  new_apointment (u_id,c_id,b_time,end_time) VALUES('$u_id','$c_id','$b_time','$end_time')";
                    $res = mysqli_query($conn,$sql);
                    header('Content-Type:application/json');
            
            
                    //checking whether query is excuted or not
                    if($res){
                        echo json_encode(['status'=>'success','result'=>'found']);
                        // count that data is there or not in database
                        
                       
                    }
        echo json_encode(['status'=>'fail','msg'=>"UNABLE TO ADD DATA"]);
    }
}

        
}
}
    
                   
            ?>