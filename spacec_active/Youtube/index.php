
<?php

 require_once './config.php';

if (isset($_POST['title'])) {
    var_dump($_POST);
    $arr_data = array(
        'title' => $_POST['title'],
        'summary' => $_POST['summary'],
        'category'=>$_POST['category'],
        'video_path' => $_FILES['file']['tmp_name'],
    );
    upload_video_on_youtube($arr_data);
}
  
function upload_video_on_youtube($arr_data) {


    $client = new Google_Client();
  
    $db = new DB();
  
    $arr_token = (array) $db->get_access_token();
    $accessToken = array(
        'access_token' => $arr_token['access_token'],
        'expires_in' => $arr_token['expires_in'],
    );
  
    $client->setAccessToken($accessToken);
  
    $service = new Google_Service_YouTube($client);
  
    $video = new Google_Service_YouTube_Video();
  //
    $videoSnippet = new Google_Service_YouTube_VideoSnippet();
    $videoSnippet->setDescription($arr_data['summary']);
    $videoSnippet->setTitle($arr_data['title']);
    //var_dump($videoSnippet);
    $video->setSnippet($videoSnippet);
  
    $videoStatus = new Google_Service_YouTube_VideoStatus();
    $videoStatus->setPrivacyStatus('public');
    $video->setStatus($videoStatus);
   // var_dump( $video);
    try {
        $response = $service->videos->insert(
            'snippet,status',
            $video,
            array(
                'data' => file_get_contents($arr_data['video_path']),
                'mimeType' => 'video/*',
                'uploadType' => 'multipart'
            )
        );
$video_id=$response->id;
        $playlistItem = new Google_Service_YouTube_PlaylistItem();

    // Add 'snippet' object to the $playlistItem object.
    $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();
    $playlistItemSnippet->setDescription($arr_data['summary']);
    $playlistItemSnippet->setPlaylistId($arr_data['category']);
    $playlistItemSnippet->setPosition(0);
    $resourceId = new Google_Service_YouTube_ResourceId();
    $resourceId->setChannelId('UCSFXd8_Kp1a5ZHAaOejPiHA');
    $resourceId->setKind('youtube#video');
    $resourceId->setVideoId( $response->id);
    $playlistItemSnippet->setResourceId($resourceId);
    $playlistItemSnippet->setTitle($arr_data['title']);
    $playlistItem->setSnippet($playlistItemSnippet);
    
    // Add 'status' object to the $playlistItem object.
    $playlistItemStatus = new Google_Service_YouTube_PlaylistItemStatus();
    $playlistItemStatus->setPrivacyStatus('public');
   $playlistItem->setStatus($playlistItemStatus);
   $db->UploadVideos();
  
    $response = $service->playlistItems->insert('snippet', $playlistItem);
    print_r($response);
        echo "Video uploaded successfully. Video ID is ". $response->id;
    } catch(Exception $e) {
        if( 401 == $e->getCode() ) {
            $refresh_token = $db->get_refersh_token();
  
            $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);
  
            $response = $client->request('POST', '/o/oauth2/token', [
                'form_params' => [
                    "grant_type" => "refresh_token",
                    "refresh_token" => $refresh_token,
                    "client_id" => GOOGLE_CLIENT_ID,
                    "client_secret" => GOOGLE_CLIENT_SECRET,
                ],
            ]);
  
            $data = (array) json_decode($response->getBody());
            $data['refresh_token'] = $refresh_token;
  
            $db->update_access_token(json_encode($data));
            $user=$_SESSION['id'];
            $title=$_POST['title'];
            $summary=$_POST['summary'];
            $category=$_POST['category'];
            $db->upload_video_to_db($video_id, $title, $summary,$category,$user);
        } else {
            echo $e->getMessage(); //print the error just in case your video is not uploaded.
        }
    }
}
?>
 <!-- <form method="post" enctype="multipart/form-data">
    <p><input type="text" name="title" placeholder="Enter Video Title" /></p>
    <p><textarea name="summary" cols="30" rows="10" placeholder="Video description"></textarea></p>
    <p><input type="file" name="file" /></p>
    <input type="submit" name="submit" value="Submit" />
</form>  -->