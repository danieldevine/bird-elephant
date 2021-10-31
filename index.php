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

$twitter = new ElephantBird($credentials);

// $following = $twitter->user('coderjerk')->following([
//     //add some query parameters
//     'max_results' => 20,
//     'user.fields' => 'profile_image_url'
// ]);

// echo "Following Count: {$following->meta->result_count} ";
// echo "Next Token: {$following->meta->next_token}";

// foreach ($following->data as $follower) {
//     echo "<div>";
//     echo "<img src='{$follower->profile_image_url}' alt='{$follower->name}'/>";
//     echo "<h3>{$follower->name}</h3>";
//     echo "</div>";
// }

//follow a user by handle - the first handle must be the authorised user
// $follow = $twitter->user('coderjerk')->follow('jack');
// dump($follow);

// //unfollow a user by handle - the first handle must be the authorised user
// $unfollow = $twitter->user('coderjerk')->unfollow('jack');
// dump($unfollow);

// Mute a user by handle - the first handle must be the authorised user
$mute = $twitter->user('coderjerk')->unblock('jack');
dump($mute);
