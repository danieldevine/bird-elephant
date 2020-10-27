<?php
require_once('bootstrap.php');

use Coderjerk\TwitterSearch\RecentSearch;

$params = [
    'query'        => 'football has:images ',
    'max_results'  => 14,
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
    'max_results'  => 10,
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