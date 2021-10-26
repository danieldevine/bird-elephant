<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;

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

$elephant_bird = new ElephantBird($credentials);

$test = $elephant_bird->twitter('tweets/search/recent', 'GET', ['query' => 'sport']);

// $user = $twitter->user('coderjerk');

// $followers = $user->followers();
// $following = $user->following();
// $blocks = $user->blocks();

dump($test);
