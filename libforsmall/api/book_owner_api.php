<?php

include '../../Db_Connection/db_libforsmall.php';
$sql = "SELECT DISTINCT spaceece.users.u_name as Name,spaceece.users.u_email as EmailID, spaceece.users.u_mob as MobileNumber, 
spaceece.users.City as City, spaceece.users.LocalAddress as LocalAddress,spaceece.users.State as State,
spaceece.users.Suburban as Suburban from spaceece.users join libforsmall.products
 WHERE spaceece.users.u_id=libforsmall.products.user_id";
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


              $result[]=  array('Name' => $row['Name'],
                             'EmailID'=>$row['EmailID'],
                             'MobileNumber'=>$row['MobileNumber'],
                             'City'=>$row['City'],
                             'LocalAddress'=>$row['LocalAddress'],
                             'State'=>$row['State'],
                             'Suburban'=>$row['Suburban']
                             ); 
               
                
                //$arr['RandomUID']=bin2hex($bytes);  // making array of data

            }
            echo json_encode(['status' => 'success', 'data' => $result, 'result' => 'found']);
            //echo json_encode(['status'=>'success','result'=>'found']);


        } else {
            echo json_encode(['status' => 'failure', 'result' => 'not found']);
        }
    }