# Bird Elephant 🪶🐘

### Connect to Twitter API v2 Early Access endpoints in PHP.
This package provides a number of convinient ways to interact with the new Twitter Rest API v2 endpoints in PHP. These endpoints are early access so subject to change. As a consequence this package is certain to change too.

This package does not support v1.1.


## Getting Started

To use the Twitter API v2, and consequently this package, you must have an approved developer account and have activated the new developer portal.

Learn more about getting access to the Twitter API v2 endpoints:

[Twitter Api Getting Started Docs](https://developer.twitter.com/en/docs/twitter-api/getting-started/guide)


## Install

Install via composer.

```bash
$ composer require coderjerk/bird-elephant
```

### Authentication

You will need to generate your credentials when creating your App in Developer Portal. Follow the Twitter developer documentation above on how to do this. Make sure to grant your app the correct permissions, and enable 3 legged OAuth if you need it.

Pass the credentials as a key value array as follows:

```php
$credentials = array(
    'bearer_token' => xxxxxx, // OAuth 2.0 Bearer Token requests
    'consumer_key' => xxxxxx, // identifies your app, always needed
    'consumer_secret' => xxxxxx, // app secret, always needed
    'token_identifier' => xxxxxx, // OAuth 1.0a User Context requests
    'token_secret' => xxxxxx, // OAuth 1.0a User Context requests
);

$twitter = new BirdElephant($credentials);
```
[Twitter Developer Authentication docs](https://developer.twitter.com/en/docs/authentication/overview)

Of course, in user context auth flows, you will need to pass the authenticated user's credentials as token_identifier and token_secret. Use an established library for oAuth 1 flows. I'm using [thephpleague/oauth1-client](https://github.com/thephpleague/oauth1-client), for example. You can look at [index.php](/index.php) and [authenticate.php](/authenticate.php) for an example of how a simple auth flow might work in practice.

Protect your credentials carefully and never commit them to your repository. I'd recommend using a .env file to manage your credentials, you can copy the contents of .env.example to .env in your project and populate with your own credentials if you wish:  [how to use it here](https://github.com/vlucas/phpdotenv)

## Quick Examples

The package provides a number of different ways of interacting with the Twitter API. The recommended way is by using the simple helper methods, but a utility method is available and direct access to many of the underlying classes is also possible. If you wish to interact with the underlying classes, read the documentation in the code.
Refer to the Twitter API docs for each endpoint to see what parameters are available to you, and then pass them as an array.

```php
use Coderjerk/BirdElephant;

//your credentials, should be passed in via $_ENV or similar, don't hardcode.
$credentials = array(
    'bearer_token' => xxxxxx,
    'consumer_key' => xxxxxx,
    'consumer_secret' => xxxxxx,
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



// Finally, you can also use the sub classes / methods directly if you like:
$user = new UserLookup($credentials);
$user = $user->getSingleUserByID('2244994945', null);

```
Lookup endpoints will return 2 objects - data and meta. How you use them is up to you, but here's a simple example of looping through follower data:

```php
$following = $twitter->user('coderjerk')->following([
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

foreach ($followers->data as $follower) {
    echo "<div>";
    echo "<img src='{$follower->profile_image_url}' alt='{$follower->name}'/>";
    echo "<h3>{$follower->name}</h3>";
    echo "</div>";
}
```
The meta object includes a 'next token' for use in pagination, as well as a count of results.

```php
echo "Followers Count: {$followers->meta->result_count} ";
echo "Next Token: {$followers->meta->next_token}";
```

## Reference &amp; Examples:

The helper methods follow the naming and structure of the Api as closely as possible. Further information for each set of endpoints here:

- [Users](/docs/Users.md)
- [Tweets](/docs/Tweets.md)
- [Compliance](/docs/Compliance.md)
- [Lists](/docs/Lists.md)
- [Spaces](/docs/Spaces.md)

[Twitter api reference index](https://developer.twitter.com/en/docs/api-reference-index)


## Notes

This is an unofficial tool written by me in my spare time and is not affiliated with Twitter in any way.

<!-- Note that operator support is quite sparse at the moment which makes the use of tweets and media more than a little risky in some contexts - for example filtering NSFW content is not yet possible. I don't know if this is in Twitter's plans or not. -->

## Contributing

Fork/download the code and run

`composer install`

To run tests

`./vendor/bin/phpunit`

Issues, pull requests and other contributions most welcome. Please read the code of conduct and use the issue template provided.

You can [look at the project board for upcoming features](https://github.com/danieldevine/bird-elephant/projects/1) if you want to pitch in :)
