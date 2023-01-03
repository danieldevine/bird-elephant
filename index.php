<?php

require_once('bootstrap.php');

use Coderjerk\BirdElephant\BirdElephant;

session_start();

if (isset($_SESSION['oauth-2-access-token'])) {
    $token = $_SESSION['oauth-2-access-token'];
}

if (isset($_SESSION['oauth-2-access-token']) && $token->hasExpired()) {

    $provider = new Smolblog\OAuth2\Client\Provider\Twitter([
        'clientId'     => $_ENV['OAUTH2_CLIENT_ID'],
        'clientSecret' => $_ENV['OAUTH2_CLIENT_SECRET'],
        'redirectUri'  => $_ENV['TWITTER_CALLBACK_URI'],
    ]);

    $newToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $token->getRefreshToken()
    ]);

    $_SESSION['oauth-2-access-token'] = $newToken;

    $token = $newToken;
}

if (!isset($_SESSION['oauth-2-access-token'])) {
    echo "<a href='authenticate.php'>Login With Twitter</a>";
    exit(1);
}

$credentials = [
    'bearer_token'     => $_ENV['TWITTER_BEARER_TOKEN'],
    'consumer_key'     => $_ENV['TWITTER_API_KEY'],
    'consumer_secret'  => $_ENV['TWITTER_SECRET'],
    'auth_token'       => $token->getToken(),
    'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
    'token_secret'     => $_ENV['TWITTER_ACCESS_TOKEN_SECRET']
];

$twitter = new BirdElephant($credentials);

// get a list of all the authenticated user's bookmarks: only available if OAuth 2.0 with PKCE auth is sucessful.
// try {
//     $me = $twitter->me()->myself()->data->username;

//     $user = $twitter->user($me);

//     $bookmarks = $user->bookmarks();
// } catch (GuzzleHttp\Exception\ClientException $e) {
//     dd($e->getResponse()->getBody()->getContents());
// }

// if ($bookmarks && $bookmarks->meta->result_count >= 1) {
//     foreach ($bookmarks->data as $bookmark) {
//         echo "<h4>{$bookmark->text}</h4>";
//     }
// } else {
//     echo "You don't have any bookmarks yet.";
// }


// git ignored file that I use for testing.
if (file_exists('scratchpad.php')) :
    require_once('scratchpad.php');
endif;
