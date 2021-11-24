<?php

use PhpParser\Node\Stmt\Foreach_;

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

$tweet_id = "1440766876049575943";
$user_id = "802448659";

$list_id = '1360747763370258442';
$params = [
    'user.fields' => 'profile_image_url,username'
];
$members = $twitter->lists()->members()->lookup($list_id, $params);

foreach ($members->data as $member) {
    echo "<img src='{$member->profile_image_url}' /></br>";
    echo $member->username . '</br>';
}
