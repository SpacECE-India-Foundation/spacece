<?php

//require_once './config.php';
//require'./config.php';
if (!file_exists('vendor/autoload.php')) {
    throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
  }
  require_once 'vendor/autoload.php';

  $client = new Google_Client();
  $client->setApplicationName('API code samples');
  $client->setScopes([
      'https://www.googleapis.com/auth/youtube.force-ssl',
  ]);
  $client->setAccessType('offline');
  //​$client->setAuthConfig('cliwl.json');
  // TODO: For this request to work, you must replace
  //       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
  //       client_secret.json file. For more information, see
  //       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
//   $client->setAuthConfig('cliwl.json');
// $client->setAccessType('offline');
  ​
  // Request authorization from the user.
  $authUrl = $client->createAuthUrl();
  printf("Open this link in your browser:\n%s\n", $authUrl);
  print('Enter verification code: ');
  $authCode = trim(fgets(STDIN));
  ​
  // Exchange authorization code for an access token.
  $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
  $client->setAccessToken($accessToken);
  ​
  // Define service object for making API requests.
  $service = new Google_Service_YouTube($client);
  ​
  // Define the $playlist object, which will be uploaded as the request body.
  $playlist = new Google_Service_YouTube_Playlist();
  ​
  // Add 'snippet' object to the $playlist object.
  $playlistSnippet = new Google_Service_YouTube_PlaylistSnippet();
  $playlistSnippet->setTitle('hello');
  $playlist->setSnippet($playlistSnippet);
  ​
  $response = $service->playlists->insert('snippet,status', $playlist);
  print_r($response);
?>