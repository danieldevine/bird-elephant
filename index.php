<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\Timeline;


$timeline = new Timeline;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$mentions = $timeline->getMentions('802448659', $params);

d($mentions);

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$tweets = $timeline->getTweets('802448659', $params);

d($tweets);
