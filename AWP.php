<?php
include 'fbsdk/autoload.php';
//---------ACCESSTOKENPROVIDE--------------------//
// Как я понял, подразумевается, что уже извесен отсюда https://developers.facebook.com/tools/explorer
// маркер доступа к странице. В дальнейшем банально или кодом можно, или выполняется там же в Explorer команда:
//oauth/access_token?grant_type=fb_exchange_token&client_id=[ID ПРИЛОЖЕНИЯ]&client_secret=
//[секрет приложения]&fb_exchange_token=[МАРКЕР ДОСТУПА К СТРАНИЦЕ]. Ну а дальше понятно все.
//---------------------------------------------//
$fb = new Facebook\Facebook([
  'app_id' => '897063643765554',
  'app_secret' => '7f6aa922e415b4968b9b459ab8a4ae98',
  'default_graph_version' => 'v2.9',
  ]);
$accessToken = 'EAAMv3ZBfT2zIBADsJQv9fbzM0i0J1Jp7ylXIsDwQfPp3CCPSyXTKkdMZC7qSx6GtGTq1BboI8DkjHZCYtrff94qYNQUzeQJxFVQApzUgAs7JaGW1SURJK1nZAYxhxU5DCPxP5GmNRAuYX8RuZAoO0dv59TOkOgbOzgTB4vZCxZBEUzKGqC4ucUT';
//------------------ССЫЛОЧКИ НА КАНАЛЬЧИКИ-----------------//
$linkData = [
  'link' => 'http://www.twitch.tv/happasc2',
  'message' => 'HAPPA В ТЕЛЕВИЗОРЕ!!!',
  ];
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/feed', $linkData, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
echo 'Posted with id: ' . $graphNode['id'];
$linkData = [
  'link' => 'https://www.twitch.tv/sinedd92',
  'message' => 'А ЭТО СИНЕДД В ТЕЛЕВИЗОРЕ!!!',
  ];
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/feed', $linkData, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
echo 'Posted with id: ' . $graphNode['id'];
//------------------ФОТКА-----------------//
$data = [
  'message' => 'МАМА ЭТО Я',
  'source' => $fb->fileToUpload('C:/Users/Lianel/Desktop/Main/All/luls.png'),
];
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/photos', $data, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
echo 'Photo ID: ' . $graphNode['id'];
//------------------ВИДЕО-------------------//
$data = [
  'title' => 'ХАЛАТИКИ ПОДЪЕХАЛИ',
  'description' => 'БЕСПАЛЕВНАЯ ИДЕЯ',
  'source' => $fb->videoToUpload('C:/Users/Lianel/Desktop/vandam.mp4'),
];
try {
  $response = $fb->post('/me/videos', $data, $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();
var_dump($graphNode);
echo 'Video ID: ' . $graphNode['id'];
?>