<?php  // this is serverside page === api key?>
<?php $DBHOST = 'localhost';
$DBUSER = 'ostechnix';
$DBPASS = 'Password123#@!';
$DBNAME = 'gallery2';
$conn;

$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
?>

<?php
       
        $sql= "SELECT *
        FROM `videos`
        ORDER BY `views` DESC
        Limit 5";
        $res = mysqli_query($conn,$sql);
        header('Content-Type:application/json');   // connecting to database
        header('Acess-Control-Allow-Origin: *');

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