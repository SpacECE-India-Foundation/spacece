
<?php
include '../Db_Connection/db_spacece_active.php';


if (function_exists('date_default_timezone_set')) {
    date_default_timezone_set("Asia/Kolkata");
}

// then use the date functions, not the other way around
$date1 = date('Y-m-d');


$query1 = mysqli_query($mysqli1, "Select * from spaceactive_activities") or die('Sql Query2 Error');

while($result = mysqli_fetch_assoc($query1)){


if($result){

    $arr[]=$result;
//    $arr=array(); 
//     function recursiveStripTags($result) {
//         foreach ($result as $key => $value) {
//             if(is_array($value)) {
//                 $arr[$key] = recursiveStripTags($value);
//             }
//             else {
//                 $arr[$key] = strip_tags($value);
//             }
//         }
//         return $arr;
//     }

   // return $arr;
   // echo json_encode($result);
    // $act_date = $result['activity_date'];
    // $act_id = $result['activity_no'];
    // $activity_name = $result['activity_name'];
    // $activity_level = $result['activity_level'];
    // $activity_dev_domain = $result['activity_dev_domain'];
    // $activity_objectives = $result['activity_objectives'];
    // $activity_key_dev = $result['activity_key_dev'];
    // $activity_material = $result['activity_material'];
    // $activity_assessment = $result['activity_assessment'];
    // $activity_process = $result['activity_process'];
    // $activity_instructions = $result['activity_instructions'];
    
//    $query = mysqli_query($mysqli1, "Select spaceece.users.u_id,spaceece.users.u_name,spaceece.users.u_email,spaceece.users.u_mob from spaceece.users JOIN space_active.sub_users WHERE space_active.sub_users.u_id=spaceece.users.u_id") or die('Sql Query1 Error' . mysqli_error($mysqli));
    
//     while ($result1 = mysqli_fetch_assoc($query)) {
//         $uid = $result1['u_id'];
//         $umob = $result1['u_mob'];
//         $name = $result1['u_name'];
//         $email = $result1['u_email'];
    
//        sendEmail($name, $email, $act_id, $activity_name, $activity_level, $activity_dev_domain, $activity_objectives, $activity_key_dev, $activity_material, $activity_assessment, $activity_process, $activity_instructions,$uid);
//     } 
}
echo json_encode($arr);
$data = recursiveStripTags($arr);

echo json_encode(['success' => true, 'data' => $data]);
function recursiveStripTags($data) {
    foreach ($data as $key => $value) {
        if(is_array($value)) {
            $data[$key] = recursiveStripTags($value);
        }
        else {
            $data[$key] = strip_tags($value);
        }
    }
  
    return $data;
}

}