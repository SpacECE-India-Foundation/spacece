<?php
include '../../Db_Connection/db_libforsmall.php';

$sql = "SELECT product_desc as Description,product_keywords as History,product_image as ImageURL,user_id as OwnerId,product_price as Price,product_qty as Quantity FROM `products`;";
    $res = $conn->query($sql);
    header('Content-Type:application/json');

    if ($res) {
        // count that data is there or not in database
        $count = mysqli_num_rows($res);
        $sno = 1;
        if ($count > 0) {
            // we have data in database
            while ($row = mysqli_fetch_assoc($res)) {
                $bytes = random_bytes(20);


              $result[]=  array('Description' => $row['Description'],
                             'History'=>$row['History'],
                             'ImageURL'=>'https://spacefoundation.in/test/SpacECE-PHP/libforsmall/product_images/'.$row['ImageURL'],
                             'OwnerId'=>$row['OwnerId'],
                             'Price'=>$row['Price'],
                             'Quantity'=>$row['Quantity'],
                             'RandomUID'=>bin2hex($bytes)
                             ); 
               
                
                //$arr['RandomUID']=bin2hex($bytes);  // making array of data

            }
            echo json_encode(['status' => 'success', 'data' => $result, 'result' => 'found']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        } else {
            echo json_encode(['status' => 'failure', 'result' => 'not found']);
        }
    }
