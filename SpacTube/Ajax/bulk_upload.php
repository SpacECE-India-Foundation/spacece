<?php



$mysqli = new mysqli('3.109.14.4','ostechnix' , 'Password123#@!', 'gallery2');

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  //  exit();
}

if(isset($_GET['bulk'])){


//echo $mysqli;
    
        $id=$_POST['video_code'];
        $title=$_POST['title'];
        echo implode(', ',$id);
        //$date=$_POST['date'];
        $desc=$_POST['desc'];
        $length=$_POST['length'];
            $status=$_POST['status'];
            $filter=$_POST['filter'];
    $date=date('y-m-d');
        $field['v_url'] = $id;
        //$field['v_date'] = $id;
        $field['status'] = $status;
        $field['filter'] = $filter;
        $field['title'] = $title;
        $field['desc'] = $desc;
        $field['length'] = $length;
        $field['v_date'] = date('y-m-d');
        $field['v_uni_no'] = rand(1000000000000000, 10000000000000000);
        $fiel = rand(1000000000000000, 10000000000000000);
        $result=bulk_upload($id,$title,$desc,$length,$status,$filter,$date,$fiel,$mysqli);
    //     $ins_video = $Fun_call->insert('videos', $field);

    //     if($ins_video){

    //         $js_data['status'] = 101;
    //         $js_data['msg'] = 'Inserted Success';

    //     }
    //     else{

    //         $js_data['status'] = 102;
    //         $js_data['msg'] = 'Insert Failed';

    //     }

    // }
    // else{

    //     $js_data['status'] = 103;
    //     $js_data['msg'] = 'Invalid Data Found';

    // }
    
}
function bulk_upload($id,$title,$desc,$length,$status,$filter,$date,$fiel,$mysqli){
    $sql="Insert into videos (v_id,v_url,v_date,v_uni_no,status,filter,title,desc,length)values(" . implode(', ',$id) . "," . implode(', ',$date) . "," . implode(', ',$fiel) . "," . implode(', ',$status) . "," . implode(', ',$filter) . "," . implode(', ',$title) . "," . implode(', ',$desc) . "," . implode(', ',$length) . ",)";
//$sql="Insert into videos (v_id,v_url,v_date,v_uni_no,status,filter,title,desc,length)values('$id','$date'$fiel ','$status','$filter','$title)','$desc',$length') or die($mysqli->connect_error)";
  echo $sql; 
 
 $insert=mysqli_query($mysqli,$sql);
   var_dump($insert);
}
