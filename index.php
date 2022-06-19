<?php

require_once('bootstrap.php');

use Coderjerk\BirdElephant\BirdElephant;

session_start();

if (!isset($_SESSION['oauth-2-token'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$credentials = [
    'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key' => $_ENV['TWITTER_API_KEY'],
    'consumer_secret' => $_ENV['TWITTER_SECRET'],
    'token_identifier' => '',
    'token_secret' => '',
    'auth_token' => $_SESSION['oauth-2-token']
];

$twitter = new BirdElephant($credentials);

if (file_exists('scratchpad.php')) :
    require_once('scratchpad.php');
endif;
