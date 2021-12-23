<?php
 include("indexDB.php");


$u_id=$_POST['u_id'];
$c_id=$_POST['c_id'];
$b_time=$_POST['b_time'];
       
        $sql = "INSERT INTO  new_apointment (u_id,c_id,b_time) VALUES('$u_id','$c_id','$b_time')";
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');


        //checking whether query is excuted or not
        if($res){
            // count that data is there or not in database
            $count= mysqli_num_rows($res);
            $sno =1;
            if($count>0){
                // we have data in database
                while($row = mysqli_fetch_assoc($res))
                {

                    $arr[] = $row;   // making array of data
                 
                }
               echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    
                    // displaying value in table
            ?>