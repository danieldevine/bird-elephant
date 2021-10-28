# Elephant Bird

### Connect to Twitter API v2 Early Access endpoints in PHP.
This package provides a number of convinient ways to interact with the new Twitter Rest API v2 endpoints in PHP. These endpoints are early access so subject to change. As a consequence this package is likely to change too. This package does not support v1 endpoints.

## Getting Started

To use the Twitter API v2, and consequently this package, you must have an approved developer account and have activated the new developer portal.

Learn more about getting access to the Twitter API v2 endpoints:

[Twitter Api Getting Started Docs](https://developer.twitter.com/en/docs/twitter-api/getting-started/guide)


## Install

Install via composer.

```bash
$ composer require coderjerk/elephant-bird
```

### Authentication

You will need to generate your credentials when creating your App in Developer Portal. Follow the Twitter developer documentation above on how to do this. Make sure to grant your app the correct permissions, and enable 3 legged OAuth if you need it.

Pass them as a key value array as follows:

```php
$credentials = array(
    'bearer_token' => xxx,
    'consumer_key' => xxx,
    'consumer_secret' => xxx,
    'token_identifier' => xxx,
    'token_secret' => xxx,
);

$twitter = new ElephantBird($credentials);

```

If you're only using Bearer auth then you can omit the last two values.


[Twitter Developer Authentication docs](https://developer.twitter.com/en/docs/authentication/overview)

OAuth 1.0a User Context - supported
OAuth 2.0 Bearer Token - supported
Basic Auth - Enterprise API only, not supported


##### Tips
Use an established library for oAuth 1 flows. I'm using [thephpleague/oauth1-client](https://github.com/thephpleague/oauth1-client), for example. You can look at [index.php](/index.php) and [authenticate.php](/authenticate.php) for an example of how a simple auth flow might work in practice.

Protect your credentials carefully and never commit them to your repository.

I'd recommend using a .env file to manage your credentials, you can copy the contents of .env.example to .env in your project and populate with your own credentials if you wish:  [how to use it here](https://github.com/vlucas/phpdotenv)

## Reference &amp; Examples:

- [Users](/docs/Users.md)
- [Tweets](/docs/Tweets.md)
- [Compliance](/docs/Compliance.md)
- [Lists](/docs/Lists.md)
- [Spaces](/docs/Spaces.md)

## Notes

This is an unofficial tool and not affiliated with Twitter in any way.

Note that operator support is quite sparse at the moment which makes the use of tweets and media more than a little risky in some contexts - for example filtering NSFW content is not yet possible. I don't know if this is in Twitter's plans or not.

## Contributing

Fork/download the code and run
`composer install`

Issues, pull requests and other contributions most welcome. Please read the code of conduct and use the issue template provided.



You can [look at the project board here for upcoming features:](https://github.com/danieldevine/elephant-bird/projects/1)
