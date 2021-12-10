<h6 class="card-title"><?php echo $video_data['title']; ?></h6>

                                        <?php echo $video_data['v_date']; ?> <br>
                                        <a href="likecnt.php?btn=<?php echo $video_data['v_id'] ?>">
                                            <button name="likecnt" class ="btn"><i class="fas fa-thumbs-up" style="color:black"></i></button>
                                            
                                        </a>
                                        <?php echo $video_data['cntlike']; ?>
                                        <a href="likecnt.php?btn1=<?php echo $video_data['v_id'] ?>">
                                            <button name="dislikecnt" class = "btn"><i class="fas fa-thumbs-down" style="color:black"></i></button>
                                            
                                        </a>
                                        <?php echo $video_data['cntdislike']; ?>
                                        <button name="share" class = "btn"><a href="whatsapp://send?text=<?php echo "*SpacTube - Video Gallery on Child Education* %0a %0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=". $video_data['v_url'] . " %0a %0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube %0a %0aThanks and Regards, %0aSpacECE India Foundation %0a %0awww.spacece.co %0awww.spacece.in %0a"; ?>" data-action="share/whatsapp/share" target="_blank"><i class="fas fa-share-alt" style="color:black"></i></a></button>
                                        <!-- <a href="comment.php">
                                            <button name="comment" class="btn"><img src="comments.png" style="justify-content: center; padding-left: 30%; height: 20px; width: 35px"></button>
                                        </a> -->




                                        <!-- if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
  throw new Exception(sprintf('Please run "composer require google/apiclient:~2.0" in "%s"', __DIR__));
}
require_once __DIR__ . '/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('API code samples');
$client->setScopes([
    'https://www.googleapis.com/auth/youtube.force-ssl',
]);

// TODO: For this request to work, you must replace
//       "YOUR_CLIENT_SECRET_FILE.json" with a pointer to your
//       client_secret.json file. For more information, see
//       https://cloud.google.com/iam/docs/creating-managing-service-account-keys
$client->setAuthConfig('YOUR_CLIENT_SECRET_FILE.json');
$client->setAccessType('offline');

// Request authorization from the user.
$authUrl = $client->createAuthUrl();
printf("Open this link in your browser:\n%s\n", $authUrl);
print('Enter verification code: ');
$authCode = trim(fgets(STDIN));

// Exchange authorization code for an access token.
$accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
$client->setAccessToken($accessToken);

// Define service object for making API requests.
$service = new Google_Service_YouTube($client);

$service->videos->rate('nvoFj0OMQHQ', 'dislike'); -->
