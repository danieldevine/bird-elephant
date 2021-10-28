<?php
// Example auth workflow, pulled almost verbatim from League OAuth client docs

require_once('bootstrap.php');

$server = new League\OAuth1\Client\Server\Twitter([
    'identifier' => $_ENV['TWITTER_API_KEY'],
    'secret' => $_ENV['TWITTER_SECRET'],
    'callback_uri' =>  $_ENV['TWITTER_CALLBACK_URI'],
    'scope' => 'write'
]);

session_start();

if (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) {

    $temporaryCredentials = unserialize($_SESSION['temporary_credentials']);

    $tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']);

    unset($_SESSION['temporary_credentials']);

    $_SESSION['token_credentials'] = serialize($tokenCredentials);
    session_write_close();

    header("Location: https://{$_SERVER['HTTP_HOST']}/");

    exit;
} elseif (isset($_GET['denied'])) {

    echo 'You have denied access to your Twitter account. If you did this by mistake, you should <a href="?go=go">try again</a>.';
} elseif (isset($_GET['go'])) {

    $temporaryCredentials = $server->getTemporaryCredentials();

    $_SESSION['temporary_credentials'] = serialize($temporaryCredentials);
    session_write_close();

    $server->authorize($temporaryCredentials);
} else {
    echo '<a href="?go=go">Login</a>';
}
