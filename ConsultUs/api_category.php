<?php  // this is serverside page === api key ?>
<?php 
error_reporting(0);
      $category= $_GET['category'];
  $val=$_GET['val'];
?>
<?php include("./includes/functions.php")?>
<?php

if($category == "one"){
        // showing admin added from database
        $sql = "SELECT * FROM `consultant_category` WHERE `category`= '$val' ";
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

    }
                    // displaying value in table
        
elseif($category= "all"){
        // showing admin added from database
        $sql = "SELECT * FROM `consultant_category`";
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
                    


                    $arr[] =$row['category'];   // making array of data
                 
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

