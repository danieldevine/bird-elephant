<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\FilteredStream;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$filteredStream = new FilteredStream;

// set a rule
$rules = $filteredStream->setRules('motorbike', 'driving is fun');

d($rules);

// //get rules
// $rules = $filteredStream->getRules();


// //delete all rules
// $rules = $filteredStream->deleteAllRules();

// //delete one rule by id
// $rules = $filteredStream->deleteRule('1321464585245908993');

// d($rules);

// // connect to filtered stream
// $stream = $filteredStream->connectToStream($params);

// $json = json_decode($stream);

// d($json);
