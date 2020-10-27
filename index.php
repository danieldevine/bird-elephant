<?php
require_once('bootstrap.php');

use Coderjerk\TwitterSearch\RecentSearch;
use Coderjerk\TwitterSearch\TweetLookup;

$params = [
    'query'        => 'football has:images ',
    'max_results'  => 14,
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
];

$search = new RecentSearch;
$result = $search->RecentSearchRequest($params);

$tweets = $result->data;
$media  = $result->includes->media;

foreach ($tweets as $tweet) {
    echo $tweet->text;
}

foreach ($media as $medium) {
    echo '<img src="' . $medium->url . '">';
}

$ids = [
    '1261326399320715264',
    '1278347468690915330'
];

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$lookup = new TweetLookup;
$tweets = $lookup->getTweetsById($ids, $params);

d($tweets);

$ids = ['1261326399320715264'];

$lookup = new TweetLookup;
$tweets = $lookup->getTweetsById($ids, $params);

d($tweets);