<?php
require_once 'vendor/autoload.php';
require_once 'class-db.php';
  
define('GOOGLE_CLIENT_ID', '358733321213-ok61mfrei01h9c6r3acailefmmf5nevl.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'https://spacefoundation.in/test/SpacECE-PHP/spacec_active/Youtube/callback.php',
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

