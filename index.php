<?php

require_once('bootstrap.php');

session_start();

if (!isset($_SESSION['token_credentials'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$tokenCredentials = unserialize($_SESSION['token_credentials']);

$credentials = array(
    'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key' => $_ENV['TWITTER_API_KEY'],
    'consumer_secret' => $_ENV['TWITTER_SECRET'],
    'token_identifier' => $tokenCredentials->getIdentifier(),
    'token_secret' => $tokenCredentials->getSecret(),
);


$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);

try {
    $user = $twitter->user('coderjerk');
    $user_lists = $user->lists()->owned();
    $list_id = $user_lists->data[0]->id;
    $tweets = $twitter->lists()->tweets()->lookup($list_id);
    var_dump($tweets);
} catch (Exception $e) {
    dump($e->getResponse()->getBody()->getContents());
}
