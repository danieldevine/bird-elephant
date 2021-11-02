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

//Mute a user by handle - the first handle must be the authorised user
// $mute = $twitter->user('coderjerk')->follow('jack');
// dump($mute);

// $recent = $twitter->tweets()->counts($params = ['query' => 'test'])->recent();
// dump($recent);

// $tweet = $twitter->tweets()->lookup()->getTweet('1278347468690915330');

// $tweets = $twitter->tweets()->lookup()->getTweets(['1261326399320715264', '1278347468690915330']);
// dump($tweets);

// $timeline = $twitter->tweets()->timeline(['tweet.fields' => 'conversation_id'])->getTweets('coderjerk');
// dump($timeline);

// $search = $twitter->tweets()->search($params = ['query' => 'conversation_id:1455187677326757899'])->recent();
// dump($search);

// //note: you can't hide your own replies!!
// $hide = $twitter->tweets()->reply()->hide('1455193907352965127');
// dump($hide);

//get likers of a tweet
// $likers = $twitter->tweets()->likes($params = [])->likingUsers('1450110343137665036');
// dump($likers);

// $like = $twitter->user('coderjerk')->likes();
// dump($like);

// $likers = $twitter->tweets()->retweets($params = [])->retweetedBy('1450110343137665036');
// dump($likers);

// $lists = $twitter->user('coderjerk')->lists()->follow('1441162269824405510');
// dump($lists);

// $lists = $twitter->user('coderjerk')->lists()->unfollow('1441162269824405510');
// dump($lists);
