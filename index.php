<?php

require_once('bootstrap.php');

use Coderjerk\BirdElephant\BirdElephant;

session_start();

if (!isset($_SESSION['oauth2verifier'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

// $tokenCredentials = unserialize($_SESSION['token_credentials']);

// $credentials = [
//     'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
//     'consumer_key' => $_ENV['TWITTER_API_KEY'],
//     'consumer_secret' => $_ENV['TWITTER_SECRET'],
//     'token_identifier' => $tokenCredentials->getIdentifier(),
//     'token_secret' => $tokenCredentials->getSecret(),
// ];

// $twitter = new BirdElephant($credentials);

// if (file_exists('scratchpad.php')) :
//     require_once('scratchpad.php');
// endif;
