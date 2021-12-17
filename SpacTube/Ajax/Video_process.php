<?php

require_once '../Config/Functions.php';
$Fun_call = new Functions();
//var_dump($_POST);
$js_data = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['video_url'])){

       
          


        $video_url = $Fun_call->validate($_POST['video_url']);
	 echo"<script>alert('hello...')</script>";
        if(!empty($video_url)){
            $id=$_POST['id'];
            $title=$_POST['title'];
            $date=$_POST['date'];
            $desc=$_POST['desc'];
            $length=$_POST['length'];
                $status=$_POST['status'];
                $filter=$_POST['filter'];

            $field['v_url'] = $id;
            //$field['v_date'] = $id;
            $field['status'] = $status;
            $field['filter'] = $filter;
            $field['title'] = $title;
            $field['desc'] = $desc;
            $field['length'] = $length;
            $field['v_date'] = date('y-m-d');
            $field['v_uni_no'] = rand(1000000000000000, 10000000000000000);
            $ins_video = $Fun_call->insert('videos', $field);

            if($ins_video){

                $js_data['status'] = 101;
                $js_data['msg'] = 'Inserted Success';

            }
            else{

                $js_data['status'] = 102;
                $js_data['msg'] = 'Insert Failed';

            }

        }
        else{

            $js_data['status'] = 103;
            $js_data['msg'] = 'Invalid Data Found';

        }
        
    }
    elseif(isset($_POST['upd_video_url']) && (isset($_POST['upd_video_no']) && is_numeric($_POST['upd_video_no']))){

        $u_video_code = $Fun_call->validate($_POST['upd_video_url']);
        $u_video_no = $Fun_call->validate($_POST['upd_video_no']);

        if(!empty($u_video_code) && !empty($u_video_no)){

            $up_field['v_url'] = $u_video_code;
            $up_field['v_date'] = date('y-m-d');

            $up_condi['v_uni_no'] = $u_video_no;
            $update_video = $Fun_call->update('videos', $up_field, $up_condi);

            if($update_video){

                $js_data['status'] = 104;
                $js_data['msg'] = 'Updated';

            }
            else{

                $js_data['status'] = 105;
                $js_data['msg'] = 'Not Updated';

            }

        }
        else{

            $js_data['status'] = 106;
            $js_data['msg'] = 'Invalid Update Data';

        }

    }
    elseif(isset($_POST['de_video_no']) && is_numeric($_POST['de_video_no'])){

        $delete_no = $Fun_call->validate($_POST['de_video_no']);

        if(!empty($delete_no)){

            $de_condi['v_uni_no'] = $delete_no;
            $de_video = $Fun_call->delete('videos', $de_condi);

            if($de_video){

                $js_data['status'] = 107;
                $js_data['msg'] = 'Deleted';

            }
            else{   

                $js_data['status'] = 108;
                $js_data['msg'] = 'Not Deleted';

            }

        }
        else{

            $js_data['status'] = 110;
            $js_data['msg'] = 'Invalid Delete Data';

        }

    }
    else{
        $js_data['status'] = 111;
        $js_data['msg'] = 'Invalid Data Request';
    }

}
else{

    $js_data['status'] = 112;
    $js_data['msg'] = 'Invalid Method';

}



echo json_encode($js_data);




?>