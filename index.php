<?php

require_once('bootstrap.php');

use Coderjerk\BirdElephant\BirdElephant;

session_start();

//extremely basic example for testing purposes

if (!isset($_SESSION['oauth-2-token'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$credentials = [
    'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key' => $_ENV['TWITTER_API_KEY'],
    'consumer_secret' => $_ENV['TWITTER_SECRET'],
    'auth_token' => $_SESSION['oauth-2-token'],
    'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
    'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET']
];

$twitter = new BirdElephant($credentials);

// ignored file that I use for testing.
if (file_exists('scratchpad.php')) :
    require_once('scratchpad.php');
endif;
