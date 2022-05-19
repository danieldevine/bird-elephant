<?php

require_once('bootstrap.php');

use Coderjerk\BirdElephant\Users\UserLookup;

session_start();

if (!isset($_SESSION['token_credentials'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$tokenCredentials = unserialize($_SESSION['token_credentials']);

$credentials = [
    'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key' => $_ENV['TWITTER_API_KEY'],
    'consumer_secret' => $_ENV['TWITTER_SECRET'],
    'token_identifier' => $tokenCredentials->getIdentifier(),
    'token_secret' => $tokenCredentials->getSecret(),
];


$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);

try {
    $me = $twitter->me();
} catch (Exception $e) {
    var_dump($e->getResponse()->getBody()->getContents());
}

echo $me->myself()->data->id;
