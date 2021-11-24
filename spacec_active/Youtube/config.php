<?php
require_once 'vendor/autoload.php';
require_once 'class-db.php';
  
define('GOOGLE_CLIENT_ID', '861549903054-k9s6lhfls18ogg5r2bhbkef5vo0qsbni.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'http://localhost/spacec_active/Youtube/callback.php',
    'keys'     => [
                    'id' => GOOGLE_CLIENT_ID,
                    'secret' => GOOGLE_CLIENT_SECRET
                ],
    'scope'    => 'https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtube.upload',
    'authorize_url_parameters' => [
            'approval_prompt' => 'force', // to pass only when you need to acquire a new refresh token.
            'access_type' => 'offline'
    ]
];
  
$adapter = new Hybridauth\Provider\Google( $config );

