<?php

 require_once './Youtube/config.php';
if(isset($_POST['act_name'])){


 $act_name=$_POST['act_name'];
 $act_lvl=$_POST['act_lvl'];

 $act_dom=$_POST['act_dom'];
 $act_obj=$_POST['act_obj'];
 $pl_name=$_POST['pl_name'];
 $act_pro=$_POST['act_pro'];
 $act_key=$_POST['act_key'];
 $act_mat=$_POST['act_mat'];
 $act_asses=$_POST['act_asses'];
 $act_ins=$_POST['act_ins'];
 $act_date=$_POST['act_date'];
 $pl_desc=$_POST['pl_desc'];
 $status="Free";

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
$playlistSnippet->setChannelId('UCSFXd8_Kp1a5ZHAaOejPiHA');
// $playlistSnippet->setDescription($pl_desc);
// $playlistSnippet->setTitle($pl_name);
 $playlistSnippet->setDescription("Hello");
  $playlistSnippet->setTitle("Testing");
$playlist->setSnippet($playlistSnippet);

// Add 'status' object to the $playlist object.
$playlistStatus = new Google_Service_YouTube_PlaylistStatus();
$playlistStatus->setPrivacyStatus('public');
$playlist->setStatus($playlistStatus);

$response = $service->playlists->insert('snippet,status', $playlist);
print_r($response);
$playlist_id=$response->id;
if($response->id){
    if( $this->db->query("INSERT INTO spaceactive_activity (activity_name,activity_level,activity_dev_domain,activity_objectives,
    activity_key_dev,activity_material,activity_assessment,activity_process,activity_instructions,
    status,activity_date,playlist_id,playlist_descr,playlist_name) 
    values ('$act_name','$act_lvl','$act_dom','$act_obj','$act_key','$act_mat','$act_asses','$act_pro','$act_ins','$status','$act_date','$playlist_id','$pl_desc','$pl_name')"));
    echo "Successs";


}else{
    echo "Successs"; 
}


}
