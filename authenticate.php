<?php

require_once('bootstrap.php');
session_start();

$provider = new Smolblog\OAuth2\Client\Provider\Twitter([
    'clientId'          => $_ENV['OAUTH2_CLIENT_ID'],
    'clientSecret'      => $_ENV['OAUTH2_CLIENT_SECRET'],
    'redirectUri'       => 'https://bird-elephant.test/authenticate.php',
]);

if (!isset($_GET['code'])) {
    unset($_SESSION['oauth2state']);
    unset($_SESSION['oauth2verifier']);

    // If we don't have an authorization code then get one
    $authUrl = $provider->getAuthorizationUrl();
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
            'code_verifier' => $_SESSION['oauth2verifier'],
        ]);

        // Optional: Now you have a token you can look up a users profile data
        // We got an access token, let's now get the user's details
        $user = $provider->getResourceOwner($token);

        // Use these details to create a new profile
        printf('Hello %s!', $user->getName());
    } catch (Exception $e) {
        echo '<pre>';
        print_r($e);
        echo '</pre>';

        // Failed to get user details
        exit('Oh dear...');
    }

    // Use this to interact with an API on the users behalf
    echo $token->getToken();
}
