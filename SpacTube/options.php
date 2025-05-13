<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<h6 class="card-title"><?php echo $video_data['title']; ?></h6>

<div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0;">
    <div style="display: flex; align-items: center; gap: 20px;">
        <a href="likecnt.php?btn=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
            <i class="far fa-thumbs-up" style="font-size: 24px; color: black;"></i>
        </a>
        
        <a href="likecnt.php?btn1=<?php echo $video_data['v_id']; ?>" style="text-decoration: none;">
            <i class="far fa-thumbs-down" style="font-size: 24px; color: black;"></i>
        </a>
    </div>

    <div class="share-button sharer" style="display: flex; align-items: center;">
        <button name="share" class="btn" style="background: none; border: none; padding: 0; margin: 0;">
            <i class="fas fa-share-alt" style="font-size: 24px; color: black;"></i>
        </button>
        <div class="social top center networks-5" style="display: none;">
        <a class="fbtn share whatsapp" href="whatsapp://send?text=<?php echo urlencode('*SpacTube - Video Gallery on Child Education*%0a%0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=' . $video_data['v_url'] . '%0a%0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube%0a%0aThanks and Regards,%0aSpacECE India Foundation%0awww.spacece.co%0awww.spacece.in'); ?>" target="_blank">
                <i class="fa fa-whatsapp"></i>
            </a>
            <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>" target="_blank">
                <i class="fa fa-facebook"></i>
            </a>
            <a class="fbtn share gplus" href="https://plus.google.com/share?url=https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>" target="_blank">
                <i class="fa fa-google-plus"></i>
            </a>
            <a class="fbtn share twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode('*SpacTube - Video Gallery on Child Education*%0a%0aI am sharing one important video on Child Education.%0ahttps://www.youtube.com/watch?v=' . $video_data['v_url'] . '%0a%0aYou can also subscribe to SpacTube by clicking on the following.%0ahttps://www.spacece.co/offerings/spactube%0a%0aThanks and Regards,%0aSpacECE India Foundation%0awww.spacece.co%0awww.spacece.in'); ?>&url=https://www.youtube.com/watch?v=<?php echo $video_data['v_url']; ?>&via=creativedevs" target="_blank">
                <i class="fa fa-twitter"></i>
            </a>
        </div>
    </div>
</div>



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
