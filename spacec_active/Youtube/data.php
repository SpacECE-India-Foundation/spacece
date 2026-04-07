
<?php

require_once './config.php';



if (isset($_POST['title'])) {
//    $arr_data = array(
//        'title' => $_POST['title'],
//        'summary' => $_POST['summary'],
//        'video_path' => $_FILES['file']['tmp_name'],
//    );
  // upload_video_on_youtube($arr_data);

 
//function upload_video_on_youtube($arr_data) {

$title=$_POST['title'];
$description=$_POST['summary'];
   $client = new Google_Client();
 
   $db = new DB();

   $arr_token = (array) $db->get_access_token();
  
      
//var_dump($arr_token);
   $accessToken = array(
       'access_token' => $arr_token['access_token'],
       'expires_in' => $arr_token['expires_in'],
   );
 
   $client->setAccessToken($accessToken);
 
   $service = new Google_Service_YouTube($client);
 
   $video = new Google_Service_YouTube_Video();
 
  //  $videoSnippet = new Google_Service_YouTube_VideoSnippet();
  //  $videoSnippet->setDescription($arr_data['summary']);
  //  $videoSnippet->setTitle($arr_data['title']);
  //  $video->setSnippet($videoSnippet);
 
  //  $videoStatus = new Google_Service_YouTube_VideoStatus();
  //  $videoStatus->setPrivacyStatus('public');

  //  $video->setStatus($videoStatus);
 
  $playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
   $playlist = new Google_Service_YouTube_Playlist();
//echo "<pre>";
   // Add 'snippet' object to the $playlist object.
    
   $playlistSnippet->setDescription($title);
   $playlistSnippet->setTitle($description);
   $playlist->setSnippet($playlistSnippet);
   
   // Add 'status' object to the $playlist object.
    $playlistStatus = new Google_Service_YouTube_PlaylistStatus();
    $playlistStatus->setPrivacyStatus('public');
    $playlist->setStatus($playlistStatus);
   
   //$response = $service->playlists->insert('snippet,status', $playlist);
  // echo"$response";
   //print_r($response);
   //var_dump( $playlist);
   
   try {
    $response = $service->playlists->insert('snippet,status', $playlist);
        //  $response = $service->videos->insert(
        //      'snippet,status',
        //      $video,
        //      array(
        //          'data' => file_get_contents($arr_data['video_path']),
        //          'mimeType' => 'video/*',
        //          'uploadType' => 'multipart'
        //      )
        //  );
        //echo $response;
   //print_r($response);
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
   
            // upload_video_on_youtube($arr_data);
         } else {
             echo $e->getMessage(); //print the error just in case your video is not uploaded.
         }
     }



  //  try {
  //      $response = $service->videos->insert(
  //          'snippet,status',
  //          $video,
  //          array(
  //              'data' => file_get_contents($arr_data['video_path']),
  //              'mimeType' => 'video/*',
  //              'uploadType' => 'multipart'
  //          )
  //      );
  //      echo "Video uploaded successfully. Video ID is ". $response->id;
  //  } catch(Exception $e) {
  //      if( 401 == $e->getCode() ) {
  //          $refresh_token = $db->get_refersh_token();
 
  //          $client = new GuzzleHttp\Client(['base_uri' => 'https://accounts.google.com']);
 
  //          $response = $client->request('POST', '/o/oauth2/token', [
  //              'form_params' => [
  //                  "grant_type" => "refresh_token",
  //                  "refresh_token" => $refresh_token,
  //                  "client_id" => GOOGLE_CLIENT_ID,
  //                  "client_secret" => GOOGLE_CLIENT_SECRET,
  //              ],
  //          ]);
 
  //          $data = (array) json_decode($response->getBody());
  //          $data['refresh_token'] = $refresh_token;
 
  //          $db->update_access_token(json_encode($data));
 
  //          upload_video_on_youtube($arr_data);
  //      } else {
  //          echo $e->getMessage(); //print the error just in case your video is not uploaded.
  //      }
  //  }
}
?>
<!-- <form method="post" enctype="multipart/form-data">
   <p><input type="text" name="title" placeholder="Enter Video Title" /></p>
   <p><textarea name="summary" cols="30" rows="10" placeholder="Video description"></textarea></p>
   <p><input type="file" name="file" /></p>
   <input type="submit" name="submit" value="Submit" />
</form> -->