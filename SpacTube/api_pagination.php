<?php  // this is serverside page === api key
 include 'connection.php';
	if($_GET["pagenum"])
 	{
		$pagenum =$_GET["pagenum"];
	}
	else
	{
		$pagenum = 1;
	}

	if($_GET["pagelen"])
 	{
		$pagelen = $_GET["pagelen"];
	}
	else
	{
		$pagelen = 10;//default pagelenght is 10
	}

 $offset = $pagelen*($pagenum);

//echo 'pagelen<br> ' . htmlspecialchars($_GET["pagelen"]) . '!';

        // showing admin added from database
        $sql= "SELECT * 
	FROM `videos`
	WHERE `status`='free'
        ORDER BY `v_id`
        Limit $pagelen,$offset";

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