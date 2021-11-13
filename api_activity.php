<?php
session_start();
//site url
 define("SITEURL",'http://3.109.14.4/spac/');  
  $servername = "localhost";
    $username = "ostechnix";
    $password = "Password123#@!";
   $dbname = "activity";
   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   // Check connection
   if ($conn->connect_error)
   {
       die("Connection failed: " . $conn->connect_error);
   }
?>
<?php 
      $a_no= $_GET['ano'];
      error_reporting();

 $sql = "SELECT * FROM `activities` where activity_no = '$a_no'";
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
                    
                    $arr[] =$row;   // making array of data
                 
                }
               echo json_encode(['status'=>'success','data'=>$arr,'result'=>'found']);
               //echo json_encode(['status'=>'success','result'=>'found']);


            }
            else{
                echo json_encode(['status'=>'fail','msg'=>"NO DATA FOUND"]);
            }
        }

    ?>