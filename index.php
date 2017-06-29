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
$permissions = ['email', 'user_likes','publish_actions']; // optional

$loginUrl = $helper->getLoginUrl('http://localhost:8888/fb-post/php-graph-sdk/login-callback.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';

?>