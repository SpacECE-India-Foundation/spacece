<?php

 require_once './Youtube/config.php';

 $act_name=$_POST['act_name'];
 $act_lvl=$_POST[' act_lvl'];

 $act_dom=$_POST['act_dom'];
 $act_obj=$_POST['pl_desc'];
 $pl_name=$_POST['pl_desc'];
 $act_pro=$_POST['pl_desc'];
 $act_key=$_POST['pl_desc'];
 $act_mat=$_POST['pl_desc'];
 $act_asses=$_POST['pl_desc'];
 $act_ins=$_POST['pl_desc'];
 $act_date=$_POST['pl_desc'];
 $pl_desc=$_POST['pl_desc'];

 $client = new Google_Client();
  
// $db = new DB();
  
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
$playlistSnippet->setChannelId('UCSFXd8_Kp1a5ZHAaOejPiH');
$playlistSnippet->setDescription($pl_desc);
$playlistSnippet->setTitle($pl_name);
$playlist->setSnippet($playlistSnippet);

// Add 'status' object to the $playlist object.
$playlistStatus = new Google_Service_YouTube_PlaylistStatus();
$playlistStatus->setPrivacyStatus('public');
$playlist->setStatus($playlistStatus);

$response = $service->playlists->insert('snippet,status', $playlist);
print_r($response);



