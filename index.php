<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;
use Coderjerk\ElephantBird\Users\UserLookup;

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

// use the utility method.
// $search = $twitter->call('tweets/search/recent', 'GET', ['query' => 'sport']);

//use the helper methods
// $user = $twitter->user('coderjerk')->blocks(
//     [
//         //add some query parameters
//         'max_results' => 5,
//         'user.fields' => 'profile_image_url'
//     ]
// );

// // Use the sub methods directly if you like:
// $user = new UserLookup($credentials);
// $user = $user->getSingleUserByID('2244994945', null);

$followers = $twitter->user('coderjerk')->followers([
    //add some query parameters
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

dump($followers);

foreach ($followers->data as $follower) {
    echo "<div>";
    echo "<img src='{$follower->profile_image_url}' alt='{$follower->name}'/>";
    echo "<h3>{$follower->name}</h3>";
    echo "</div>";
}
