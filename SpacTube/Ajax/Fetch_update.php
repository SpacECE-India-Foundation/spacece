<?php

require_once '../Config/Functions.php';
$Fun_call = new Functions();

$json = array();

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    if(isset($_GET['update_no']) && is_numeric($_GET['update_no'])){

        $update_no = $Fun_call->validate($_GET['update_no']);

        $condition['v_uni_no'] = $update_no;
        $fetch_rec = $Fun_call->select_assoc('videos',$condition);

        if($fetch_rec){

            $json['status'] = 200;
            $json['code'] = $fetch_rec['v_url'];

        }
        else{

            $json['status'] = 201;
            $json['code'] = 'Request Unsuccessful';

        }

    }
    else{

        $json['status'] = 202;
        $json['code'] = 'Innalid Data';

    }

}
else{

    $json['status'] = 203;
    $json['code'] = 'Invalid Request';

}

echo json_encode($json);

?>

