<?php
session_start();

require_once('bootstrap.php');

$provider = new Smolblog\OAuth2\Client\Provider\Twitter([
    'clientId'          => $_ENV['OAUTH2_CLIENT_ID'],
    'clientSecret'      => $_ENV['OAUTH2_CLIENT_SECRET'],
    'redirectUri'       => $_ENV['TWITTER_CALLBACK_URI'],
]);

if (!isset($_GET['code'])) {
    unset($_SESSION['oauth2state']);
    unset($_SESSION['oauth2verifier']);

    //only use the scopes you actually need
    $options = [
        'scope' => [
            'tweet.read',
            'tweet.write',
            'tweet.moderate.write',
            'users.read',
            'follows.read',
            'follows.write',
            'offline.access',
            'space.read',
            'mute.read',
            'mute.write',
            'like.read',
            'like.write',
            'list.read',
            'list.write',
            'block.read',
            'block.write',
            'bookmark.read',
            'bookmark.write'
        ]
    ];

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl($options);
    $_SESSION['oauth2state'] = $provider->getState();

    // We also need to store the PKCE Verification code so we can send it with
    // the authorization code request.
    $_SESSION['oauth2verifier'] = $provider->getPkceVerifier();

    header('Location: ' . $authUrl);
    exit;

    // Check given state against previously stored one to mitigate CSRF attack
} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);

    exit('Invalid state');
} else {
    try {
        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code'],
            'code_verifier' => $_SESSION['oauth2verifier']
        ]);
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';

        // Failed to get user details
        exit('Oh dear...');
    }

    $_SESSION['oauth-2-token'] = $token->getToken();

    session_write_close();

    header("Location: https://{$_SERVER['HTTP_HOST']}/");
}
