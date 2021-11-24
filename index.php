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

$tweet_id = "1440766876049575943";
$user_id = "802448659";

$twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);

// use Coderjerk\BirdElephant\Compose\Tweet;

// $lists = $twitter->user('chips1')->lists()->memberships();

// $lists = $twitter->lists()->members()->lookup('1360747763370258442');
$lists = $twitter->lists()->get('1360747763370258442');


dump($lists);


// $tweet = (new Tweet)->text('more people need to be talking about this')
//     ->quoteTweetId('1456978214837006343');

// $twitter->tweets()->tweet($tweet);
