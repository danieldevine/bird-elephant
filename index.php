<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\FollowsLookup;


$follows = new FollowsLookup;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$followers = $follows->getFollowers('802448659', $params);

d($followers);

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$following = $follows->getFollowing('802448659', $params);

d($following);
