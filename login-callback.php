<?php

session_start();
require_once __DIR__ . '/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '',
  'app_secret' => '',
  'default_graph_version' => 'v2.6',
  "persistent_data_handler"=>"session"
  ]);


$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
    // Logged in!
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    

    $postURL = "http://localhost:8888/fb-post/php-graph-sdk/post-photo.php";
    echo '<a href="' . $postURL . '">Post Image on Facebook!</a>';

  	$response = $fb->get('/me?locale=en_US&fields=name,email,likes', $_SESSION['facebook_access_token'] );
  	$userNode = $response->getGraphUser();
  	
    echo "<pre>"; 
    print_r($userNode);
  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}