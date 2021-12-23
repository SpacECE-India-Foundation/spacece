<?php
 include("indexDB.php");


$u_id=$_POST['u_id'];
$c_id=$_POST['c_id'];

$b_time=$_POST['b_time'];
date($b_time);
       
        $sql = "INSERT INTO  new_apointment (u_id,c_id,b_time) VALUES('$u_id','$c_id','$b_time')";
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');


        //checking whether query is excuted or not
        if($res){
            echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
            // count that data is there or not in database
            
           
        } else{
            echo json_encode(['status'=>'fail','msg'=>"UNABLE TO ADD DATA"]);
        }

    
                    // displaying value in table
            ?>