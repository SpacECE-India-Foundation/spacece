
<?php
session_start();
 require_once './config.php';

if (isset($_POST['title'])) {

    $arr_data = array(
        'title' => $_POST['title'],
        'summary' => $_POST['summary'],
        'category'=>$_POST['category'],
        'playlist_id'=>$_POST['pl_id'],
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
  
    $videoSnippet = new Google_Service_YouTube_VideoSnippet();
    $videoSnippet->setChannelId('PLm0GU5IUgzTCrTNRX_ijXIatqoiat8IiC');
    $videoSnippet->setDescription($arr_data['summary']);
    $videoSnippet->setTitle($arr_data['title']);
    $videoSnippet->setDefaultLanguage('en');

    $video->setSnippet($videoSnippet);
  
    $videoStatus = new  Google_Service_YouTube_VideoStatus();
    $videoStatus->setPrivacyStatus('public');
    $video->setStatus($videoStatus);
    
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
        $user = $_SESSION['current_user_email'];
        $title=$_POST['title'];
        $summary=$_POST['summary'];
        $category=$_POST['category'];
        $pl_id=$_POST['pl_id'];
        $act_id= $_POST['id'];
       $add= $db->upload_video_to_db($video_id, $title, $summary,$category,$user,$pl_id,$act_id);
       echo $add;
                   
                        $playlistItem = new Google_Service_YouTube_PlaylistItem();
                
                        // Add 'snippet' object to the $playlistItem object.
                        $playlistItemSnippet = new Google_Service_YouTube_PlaylistItemSnippet();
                        $playlistItemSnippet->setChannelId('UCSFXd8_Kp1a5ZHAaOejPiHA');
                        $playlistItemSnippet->setDescription($summary );
                        $playlistItemSnippet->setPlaylistId($category);
                        $playlistItemSnippet->setPosition(0);
                        $resourceId = new Google_Service_YouTube_ResourceId();
                        $resourceId->setChannelId('UCSFXd8_Kp1a5ZHAaOejPiHA');
                        $resourceId->setKind('youtube#video');
                        $resourceId->setPlaylistId($pl_id);
                        $resourceId->setVideoId($video_id);
                        $playlistItemSnippet->setResourceId($resourceId);
                        $playlistItemSnippet->setTitle($title);
                        $playlistItem->setSnippet($playlistItemSnippet);
                        
                        // Add 'status' object to the $playlistItem object.
                       $playlistItemStatus = new Google_Service_YouTube_PlaylistItemStatus();
                      $playlistItemStatus->setPrivacyStatus('public');
                       $playlistItem->setStatus($playlistItemStatus);
                        
                        $response = $service->playlistItems->insert('snippet', $playlistItem);
                       // print_r($response);
                    if($response->status===200){
                        echo "Video uploaded successfully. Video ID is ". $response->id;
                    }else{
                        echo "Unable to upload Video to youtube";
                    }
        
              //  echo "Video uploaded successfully. Video ID is ". $response->id;
   // print_r($response);
        
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
            $pl_id=$_POST['pl_id'];
            $act_id= $_POST['cat_id'];

            $db->upload_video_to_db($video_id, $title, $summary,$category,$user,$pl_id,$act_id);
        } else {
            echo $e->getMessage(); //print the error just in case your video is not uploaded.
        }
    }
}
?>
