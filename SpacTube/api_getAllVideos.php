<?php  // this is serverside page === api key 
include 'connection.php';        
// showing admin added from database
        $sql = "SELECT * FROM `videos`";
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');
	header('Acess-Control-Allow-Origin: *');


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
                    $arr[] = $row;   // making array of data
                }
               
		echo json_encode(['status'=>'true','data'=>$arr,'result'=>'found']);

            }
            else{
                echo json_encode(['status'=>'true','msg'=>"NO DATA FOUND"]);
            }
        }

?>