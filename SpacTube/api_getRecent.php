<?php  // this is serverside page === api key
include '../Db_Connection/db_spaceTube.php'; 
 $uid =$_GET["uid"];
$today = date('Y-m-d');

              $sql="SELECT * FROM `videos`, `tbl_recents` WHERE `tbl_recents`.`v_id`=`videos`.`v_id` and `tbl_recents`.`vr_date`='2021-08-11' AND `tbl_recents`.`u_no`='$uid' ORDER BY `videos`.`v_id`";;
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');   // connecting to database


        //checking whether query is excuted or not
        if($res){
            // count that data is there or not in database
            $count= mysqli_num_rows($res);
            if($count>0){
                // we have data in database
                while($row = mysqli_fetch_assoc($res))
                {
                    
                    $arr[] = $row;   // making array of data
                 
                }
               echo json_encode(['status'=>'true','data'=>$arr,'result'=>'found']);   // displaying data

            }
            else{
                echo json_encode(['status'=>'true','msg'=>"NO DATA FOUND"]);   // displaying data not found msg
            }
        }
        else{
            echo "no data";
        }

            ?>