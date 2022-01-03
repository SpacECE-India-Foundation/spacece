<?php
require_once 'vendor/autoload.php';
require_once 'class-db.php';
  
define('GOOGLE_CLIENT_ID', '151284826547-71gu1qj8jco0l2gvqkt72bj8bj9k2u0a.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
  
$config = [
    'callback' => 'http://spacefoundation.in/test/SpacECE-PHP/spacec_active/Youtube/callback.php',
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

