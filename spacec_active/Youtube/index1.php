<?php


$key="AIzaSyBSLlFldlf5BYfmidW8clTbDp4E6HMmG-U";
$base_url="https://www.googleapis.com/youtube/v3/";
$channelId="UCSFXd8_Kp1a5ZHAaOejPiHA";
$max=10;

$API_URL=$base_url. "playlists?part=snippet&channelId=".$channelId."&maxResults=".$max."&key=".$key;

$file1 = file_get_contents($API_URL);
$file1 = json_decode($file1, true);
//echo "<pre>";
//var_dump($file1['items'][0]['id']);

//echo "<pre>";
?>
<select>
<?php
foreach($file1['items'] as $playlist){
    echo "<option id=".$playlist['id'].">"  .$playlist['snippet']['title']."</option>";
}
?>

<option></option>
</select>
<?php

$API_URL1=$base_url."part=snippet%2Cstatus&key=".$key." HTTP/1.1";

//$array=json_decode(data.json);
