<?php

 require_once './Youtube/config.php';
if(isset($_POST['act_name'])){


 $act_name=$_POST['act_name'];
 $act_lvl=$_POST['act_lvl'];

 $act_dom=$_POST['act_dom'];
 $act_obj=$_POST['act_obj'];
 
 $act_pro=$_POST['act_pro'];
 $act_key=$_POST['act_key'];
 $act_mat=$_POST['act_mat'];
 $act_asses=$_POST['act_asses'];
 $act_ins=$_POST['act_ins'];
 $act_date=$_POST['act_date'];

 $status=$_POST['act_type'];
 $VUpload=$_POST['VUpload'];

 if($VUpload=='1'){
    $flag=1;
 
 $pl_name=$_POST['pl_name'];
 $pl_desc=$_POST['pl_desc'];
  $client = new Google_Client();
  
$db = new DB();
  
    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );
    
    $client->setAccessToken($accessToken);  
    $service = new Google_Service_YouTube($client);

// Define the $playlist object, which will be uploaded as the request body.
$playlist = new Google_Service_YouTube_Playlist();

// Add 'snippet' object to the $playlist object.
$playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
$playlistSnippet->setChannelId('UCt6Ed7f7MRjHf03HyVnXRsw');
$playlistSnippet->setDescription($pl_desc);
$playlistSnippet->setTitle($pl_name);
//  $playlistSnippet->setDescription("Hello");
//   $playlistSnippet->setTitle("Testing");
$playlist->setSnippet($playlistSnippet);

// Add 'status' object to the $playlist object.
$playlistStatus = new Google_Service_YouTube_PlaylistStatus();
$playlistStatus->setPrivacyStatus('public');
$playlist->setStatus($playlistStatus);

$response = $service->playlists->insert('snippet,status', $playlist);
//print_r($response->id);
$playlist_id=$response->id;
//$playlist_id="PLm0GU5IUgzTCF15NmxX8aKSU-_I8Jo340";


if($playlist_id){
    $AddItems = $db->AddActivity($act_name,$act_lvl,$act_dom,$act_obj,$act_key,$act_mat,$act_asses,$act_pro,$act_ins,$status,$act_date,$playlist_id,$pl_desc,$pl_name,$flag);
    // echo $AddItems;
    
//     if($AddItems ==="Success"){
//     echo "Successs"; 
//    }else{
//     echo "Error";
//    }
   
   

}
// }else{
//     echo "Error"; 
// }
 }else{
    $flag=0;
    $playlist_id=null;
    $pl_desc=null;
    $pl_name=null;
    $db->AddActivity($act_name,$act_lvl,$act_dom,$act_obj,$act_key,$act_mat,$act_asses,$act_pro,$act_ins,$status,$act_date,$playlist_id,$pl_desc,$pl_name,$flag);
 }

}
