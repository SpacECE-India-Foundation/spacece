<?php  // this is serverside page === api key ?>
<?php error_reporting(0);
 $user = $_GET['consultant']; 
 $patient = $_GET['user'];
 $type = $_GET['type'];
 ?>
<?php include("indexDB.php")?>
<?php

        // showing admin added from database
        $sql = "SELECT * FROM `appointment` WHERE `cname` = '$user'";
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
                $sql2 = "SELECT * FROM `appointment` WHERE `username` = '$user' ";
        $res2 = mysqli_query($conn,$sql2);
        header('Content-Type:application/json');


        //checking whether query is excuted or not
        if($res2){
            // count that data is there or not in database
            $count2= mysqli_num_rows($res2);
            $sno2 =1;
            if($count2>0){
                // we have data in database
                while($row2 = mysqli_fetch_assoc($res2))
                {

                    $arr2[] = $row2;   // making array of data
                 
                }}}
               echo json_encode(['status'=>'success','consultant_given_appoint'=>$arr,'consultant_taken_appoint'=>$arr2,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

                    // displaying value in table
            ?>
