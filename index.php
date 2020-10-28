<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\RecentSearch;
use Coderjerk\ElephantBird\TweetLookup;
use Coderjerk\ElephantBird\UserLookup;
use Coderjerk\ElephantBird\FilteredStream;

// $params = [
//     'query'        => 'football has:images ',
//     'max_results'  => 14,
//     'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source',
//     'expansions'   => 'attachments.media_keys',
//     'media.fields' => 'public_metrics,type,url,width',
// ];

// $search = new RecentSearch;
// $result = $search->RecentSearchRequest($params);

// $tweets = $result->data;
// $media  = $result->includes->media;

// foreach ($tweets as $tweet) {
//     echo $tweet->text;
// }

// foreach ($media as $medium) {
//     echo '<img src="' . $medium->url . '">';
// }

// $ids = [
//     '1261326399320715264',
//     '1278347468690915330'
// ];

// $params = [
//     'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
// ];

// $lookup = new TweetLookup;
// $tweets = $lookup->getTweetsById($ids, $params);


// $ids = ['1261326399320715264'];

// $lookup = new TweetLookup;
// $tweets = $lookup->getTweetsById($ids, $params);

// $params = [
//     'user.fields' => 'id'
// ];

// $usernames = [
//     'coderjerk'
// ];

// $userLookup = new UserLookup;
// $user = $userLookup->lookupUsersByUsername($usernames, $params);

// d($user->data);
// echo $user->data->name;

// $ids = [
//     '802448659',
//     '16298441'
// ];

// $userLookup = new UserLookup;
// $user = $userLookup->lookupUsersById($ids, $params);

// d($user);

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$filteredStream = new FilteredStream;

// set a rule
// $rules = $filteredStream->setRules('joke', 'funny times');

//get rules
// $rules = $filteredStream->getRules();


// delete all rules
// $rules = $filteredStream->deleteAllRules();

//delete one rule by id
// $rules = $filteredStream->deleteRule('1321464585245908993');

// d($rules);

// connect to filtered stream
// $stream = $filteredStream->connectToStream($params);

// $json = json_decode($stream);

// d($json);
