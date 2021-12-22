<?php
include_once './indexDB.php';
include("./src/RtcTokenBuilder.php");

if(isset($_POST['create_call'])){
    $user_id=$_POST['user_id'];
    $channel_name=$_POST['channel_name'];
    $appID = "0485c1232ca7491e9ada47ae96da3160";
    $appCertificate = "704339d4531441f0afaeb62baa2a54ca";
    $channelName = "hello";
    $uid = 2882341273;
    $uidStr = $user_id;
    $role = RtcTokenBuilder::RoleAttendee;
    $expireTimeInSeconds = 3600;
    $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
    $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
    
    $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
  //  echo 'Token with int uid: ' . $token . PHP_EOL;
  //  print_r($_POST);
 //$user_id=$_SESSION['current_user_email'];

    $consult_id=$_POST['consult_id'];
 



	//$token=$_POST['token'];		
$sql="INSERT INTO agora_call(user_id,consult_id,channel_name,token) VALUES ('$user_id','$consult_id','$channel_name','$token')";
$result = mysqli_query($conn, $sql);

if ($result) {
    // header('location: login.php');
    echo json_encode(array('status' => 'success','token'=>$token));
    die();
} else {
    echo json_encode(array('status' => 'error', 'message' => "Error while Creating CAll!"));
    die();
}

}
if(isset($_POST['join_call'])){

    //$user_id=$_SESSION['current_user_email'];
    $user_id=$_POST['user_id'];
   // $user_id=$_SESSION['current_user_email'];
   // $consult_id=$_POST['consultant_id'];
    //$channel_name=$_POST['channel_name'];
                
    $sql="SELECT * from agora_call where user_id='$user_id' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
   //var_dump($row);
    if (mysqli_num_rows($result) > 0) {
        // header('location: login.php');
        echo json_encode(array('status' => 'success','token'=>$token));
        //die();
    } else {
        echo json_encode(array('status' => 'error', 'message' => "No call Found!"));
        die();
    }
    
    }
    