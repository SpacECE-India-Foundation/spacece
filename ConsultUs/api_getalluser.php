<?php  // this is serverside page === api key ?>
<?php $user = $_GET['user']; ?>
<?php include("../Db_Connection/indexDB.php")?>
<?php

if($user == "all"){
        // showing admin added from database
        $sql = "SELECT * FROM `login`";
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
                    // extracting values from dATABASE

                   /* $id=$row['v_id'];
                    $url=$row['v_url'];
                    $name=$row['title'];
                    $vedio_length=$row['length'];*/  // no need 

                    $arr[] = $row;   // making array of data
                 
                }
               echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    }
                    // displaying value in table
            ?>

<?php

if($user != "all"){
        // showing admin added from database
        $sql = "SELECT * FROM `login` WHERE `username` = '$user'";
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
                    // extracting values from dATABASE

                   /* $id=$row['v_id'];
                    $url=$row['v_url'];
                    $name=$row['title'];
                    $vedio_length=$row['length'];*/  // no need 

                    $arr[] = $row;   // making array of data
                 
                }
               echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    }
                    // displaying value in table
            ?>
