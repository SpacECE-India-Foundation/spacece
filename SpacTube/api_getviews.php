<?php  // this is serverside page === api key
include '../Db_Connection/db_spaceTube.php'; 

 $vid =$_GET["vid"];
 //$uid =$_GET["uid"];

        
       $sql= "SELECT *
       FROM `videos`
       WHERE `v_id`='$vid'
       ORDER BY `v_id`";
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

                    $arr = array('vid'=>$row['v_id'],'views'=>$row['views']);   // making array of data
                 
                }
               echo json_encode(['status'=>'true','data'=>$arr,'result'=>'found']);   // displaying data

            }
            else{
                echo json_encode(['status'=>'true','msg'=>"NO DATA FOUND"]);   // displaying data not found msg
            }
        }
        else{
            echo "error";
        }

            ?>