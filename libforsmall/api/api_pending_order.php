<?php

include '../../Db_Connection/db_libforsmall.php';
$sql = "SELECT grand_total as GrandTotalPrice,address as Address,mobile as MobileNumber,payment_id as RandomUID, user_name as Name,u_note  as Note,p_status as Status FROM `orders`";
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


              $result[]=  array('Address' => $row['Address'],
                             'GrandTotalPrice'=>$row['GrandTotalPrice'],
                             'MobileNumber'=>$row['MobileNumber'],
                             'Name'=>$row['Name'],
                             'Note'=>$row['Note'],
                             'Status'=>$row['Status'],
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