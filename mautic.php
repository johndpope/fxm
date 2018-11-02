<?php
// Bootup the Composer autoloader
include __DIR__ . '/vendor/autoload.php';  

use Mautic\Auth\ApiAuth;


// $initAuth->newAuth() will accept an array of OAuth settings
$settings = array(
    'baseUrl'      => 'https://www.musicianbooster.com/2.9.2',
    'version'      => 'OAuth1a',
    'clientKey'    => '5fs97rzglz0gsc4c8kg8wc4o4kk8gcswkcsk8s8k8cc8ssc4os',
    'clientSecret' => 'zir4z2886tws0wwwcgsso0wsgcgsc80ggskkocg40cscck0kw', 
    'callback'     => ''
);

// Initiate the auth object
$initAuth = new ApiAuth();
$auth     = $initAuth->newAuth($settings);

// Initiate process for obtaining an access token; this will redirect the user to the authorize endpoint and/or set the tokens when the user is redirected back after granting authorization

if ($auth->validateAccessToken()) {
    if ($auth->accessTokenUpdated()) {
        $accessTokenData = $auth->getAccessTokenData();

        //store access token data however you want
    }
}