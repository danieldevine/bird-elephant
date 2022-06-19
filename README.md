<img src="https://birdelephant.com/logo-bird-elephant.svg" width="300px" alt=
"Bird Elephant">


[![v2](https://img.shields.io/endpoint?url=https%3A%2F%2Ftwbadges.glitch.me%2Fbadges%2Fv2)](https://developer.twitter.com/en/docs/twitter-api) [![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.4-8892BF.svg)](https://php.net/) [![twitter](https://img.shields.io/twitter/follow/coderjerk?style=social)](https://twitter.com/coderjerk)


### Connect to Twitter API v2 endpoints in PHP.

This package provides a number of useful ways to interact with the Twitter Rest API v2 endpoints in PHP. It provides a clean and easy to understand set of methods and classes to send tweets, manage users, lookup data, and everything else that the Twitter API v2 provides, from within your app or site.

[Full documentation and examples on birdelephant.com](https://birdelephant.com)

## Getting Started

To use the Twitter API v2, and consequently this package, you must have an approved developer account and have activated the new developer portal.

Learn more about getting access to the Twitter API v2 endpoints:

[Twitter Api Getting Started Docs](https://developer.twitter.com/en/docs/twitter-api/getting-started/guide)


## Install

Install via composer.

```bash
composer require coderjerk/bird-elephant
```

## Authentication

You will need to generate your credentials when creating your App in Developer Portal.

Follow the Twitter developer documentation above on how to do this. Make sure to grant your app the correct permissions, and enable 3 legged OAuth if you need it.

Pass the credentials as a key value array as follows:

```php
$credentials = array(
    //these are preset values that you can obtain from developer portal:
    'bearer_token' => xxxxxx, // OAuth 2.0 Bearer Token requests
    'consumer_key' => xxxxxx, // identifies your app, always needed
    'consumer_secret' => xxxxxx, // app secret, always needed

    //this is a value created duting an OAuth 2.0 with PKCE authentication flow:
    'auth_token' => xxxxxx // OAuth 2.0 auth token

    //these are values created during an OAuth 1.0a authentication flow:
    'token_identifier' => xxxxxx, // OAuth 1.0a User Context requests
    'token_secret' => xxxxxx, // OAuth 1.0a User Context requests
);

$twitter = new BirdElephant($credentials);
```
[Twitter Developer Authentication docs](https://developer.twitter.com/en/docs/authentication/overview)

OAuth 2.0 Bearer token auth is the most straightforward, but will limit you to certain endpoints.

Of course, in both possible user context auth flows, you will need to pass the authenticated user's credentials as token_identifier and token_secret for OAuth 1.0a *or* 'auth_token' for OAuth 2.0.

OAuth 1.0a is supported, but it would be wise for new apps to prefer OAuth 2.0 with PKCE as certain newer endpoints only support this form of authentication, and it is posible that Twitter might drop support for it in the future.

If for some reason you pass both OAuth 1.0a and OAuth 2.0 with PKCE tokens, Bird Elephant will prefer 2.0 and try to use that token alone.

You can look at [index.php](/index.php) and [authenticate.php](/authenticate.php) for an example of how a simple auth 2.0 with PKCE flow might work in practice. Use a dedicated oAuth library for this - in the example I use [https://github.com/smolblog/oauth2-twitter](smolblog/oauth2-twitter).

Remember to include your required scopes when using oAuth 2.0 with PKCE - full list here:

https://developer.twitter.com/en/docs/authentication/oauth-2-0/authorization-code

**Protect your credentials carefully and never commit them to your repository**. I'd recommend using a .env file to manage your credentials, you can copy the contents of .env.example to .env in your project and populate with your own credentials if you wish:  [how to use it here](https://github.com/vlucas/phpdotenv)

## Documentation

[Documentation and examples for all available Bird Elephant methods can be found here.](https://birdelephant.com)


## Quick Examples

The package provides a number of different ways of interacting with the Twitter API. The recommended way is by using the simple helper methods, but a utility method is available and direct access to many of the underlying classes is also possible. If you wish to interact with the underlying classes, read the documentation in the code.


```php
use Coderjerk\BirdElephant\BirdElephant;

//your credentials, should be passed in via $_ENV or similar, don't hardcode.
$credentials = array(
    'bearer_token' => xxxxxx,
    'consumer_key' => xxxxxx,
    'consumer_secret' => xxxxxx,
    // if using oAuth 2.0 with PKCE
    'auth_token' => xxxxxx // OAuth 2.0 auth token
    //if using oAuth 1.0a
    'token_identifier' => xxxxxx,
    'token_secret' => xxxxxx,
);

//instantiate the object
$twitter = new BirdElephant($credentials);

//get a user's followers using the handy helper methods
$followers = $twitter->user('coderjerk')->followers();

//pass your query params to the methods directly
$following = $twitter->user('coderjerk')->following([
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

// You can also use the sub classes / methods directly if you like:
$user = new UserLookup($credentials);
$user = $user->getSingleUserByID('2244994945', null);

```

## Reference
- [Bird Elephant Reference](https://birdelephant.com)
- [Twitter API reference index](https://developer.twitter.com/en/docs/api-reference-index)

## Notes

This is an unofficial tool written by me in my spare time and is not affiliated with Twitter.

This package does not support Twitter API v1.1.

## Contributing

Fork/download the code and run

`composer install`

copy `.env.example` to `.env` and add your credentials for testing.

To run tests

`./vendor/bin/phpunit`

Issues, pull requests and other contributions most welcome. Please use the issue template provided.

You can [look at the project board for upcoming features](https://github.com/danieldevine/bird-elephant/projects/1) if you want to pitch in :)
