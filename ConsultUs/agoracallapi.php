<?php
include_once './indexDB.php';
include("./php/src/RtcTokenBuilder.php");
include("./php/src/RtmTokenBuilder.php");
if(isset($_POST['consult_id'])){
 
//echo 'Token with int uid: ' . $token . PHP_EOL;
    //$channel_name="hello";
	//$token=$_POST['token'];	
    $consult_id=$_POST['consult_id'];
    $user_id=$_POST['user_id'];
    $sql="SELECT * from agora_call where user_id='$user_id' and consult_id='$consult_id' ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $token=$row['token'];
    $channelname=$row['channel_name'];
   //var_dump($row);
    if (mysqli_num_rows($result) > 0) {
        $consult_id=$_POST['consult_id'];
        $user_id=$_POST['user_id'];
        $channel_name=$user_id.$consult_id;
        $appID = "464ff3e49fb3409494c0956edcec52e7";
        $appCertificate = "21f542eedcde43a38f6c292abaa8c4c2";
        $channelName =$user_id.$consult_id;
        $uid = 0;
        $uidStr = $user_id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
    
    $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
        $sql="UPDATE agora_call SET token ='$token' where user_id='$user_id' and consult_id='$consult_id' ";
        $result = mysqli_query($conn, $sql);
        echo json_encode(array('status' => 'success','token'=>$token,'channelName'=>$channelname));
    }else{

        $consult_id=$_POST['consult_id'];
        $user_id=$_POST['user_id'];
        $channel_name=$user_id.$consult_id;
        $appID = "464ff3e49fb3409494c0956edcec52e7";
        $appCertificate = "21f542eedcde43a38f6c292abaa8c4c2";
        $channelName =$user_id.$consult_id;
        $uid = 0;
        $uidStr = $user_id;
        $role = RtcTokenBuilder::RoleAttendee;
        $expireTimeInSeconds = 3600;
        $currentTimestamp = (new DateTime("now", new DateTimeZone('UTC')))->getTimestamp();
        $privilegeExpiredTs = $currentTimestamp + $expireTimeInSeconds;
    
       
     
    
    
    $token = RtcTokenBuilder::buildTokenWithUid($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpiredTs);
        $sql="INSERT INTO agora_call(user_id,consult_id,channel_name,token) VALUES ('$user_id','$consult_id','$channel_name','$token')";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            // header('location: login.php');
            echo json_encode(array('status' => 'success','token'=>$token,'channelName'=>$channelName));
            die();
        } else {
            echo json_encode(array('status' => 'error', 'message' => "Error while Creating CAll!"));
            die();
        }
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
    