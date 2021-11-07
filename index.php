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

$user = $twitter->user('coderjerk')->get();
dump($user);

$usernames = ['coderjerk', 'kennyg', 'dril'];
$params = [
    'expansions' => 'pinned_tweet_id',
    'user.fields' =>  'created_at,description,entities,id,location'
];

$users = $twitter->users()->lookup($usernames, $params);
dump($users);
