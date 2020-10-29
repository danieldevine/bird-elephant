# Elephant Bird

### Connect apps to the new Twitter API v2 early access endpoints in PHP.

---

**Note**: This package currently caters for **bearer token based app access only**. I plan to expand this as V2 matures. These endpoints are early access so subject to change. This package does not support old v1.1 endpoints.

#### Currently supported:

-   API v2
    -   Tweets
        -   Recent Search
        -   Lookup
        -   Filtered Search (basic support)
    -   Users
        -   Lookup

Twitter [have stated](https://developer.twitter.com/en/docs/twitter-api/tweets/search/introduction) that they will release a full-archive version which will make the entire archive of public Tweets available soon. "The recent and full-archive search endpoints will share common design and features and are part of the Search Tweets group of endpoints" - this package will be expanded to include this as it becomes available.

To use this package you must have an approved developer account, and have activated the new developer portal.

Learn more about getting access to the Twitter API v2 endpoints:

[Twitter Getting Started Docs](https://developer.twitter.com/en/docs/twitter-api/getting-started/guide)

### API Reference

[Twitter Recent Search Endpoint API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent)

[Lookup Multiple Tweets API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets)

[Lookup Single Tweets API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets-id)

Note that operator support is quite sparse at the moment which makes the use of tweets and media more than a little risky in some contexts - for example filtering NSFW content is not yet possible.

## Install:

Install via composer.

```bash
$ composer require coderjerk/elephant-bird
```

## Auth

Bearer token support only for now. Copy the contents of .env.example to .env in your project and populate with your own credentials that you have set up for your project in the Twitter dev portal. If you aren't using .env in your project, you will need to set it up, [details here](https://github.com/vlucas/phpdotenv)

## Examples:

Search the 14 most recent tweets relating to football and containing images.

```php
use Coderjerk\ElephantBird\RecentSearch;

$params = [
    'query'        => 'football',
    'max_results'  => 14,
];

$search = new RecentSearch;
$result = $search->RecentSearchRequest($params);

$tweets = $result->data;

```

Search for media:

```php
use Coderjerk\ElephantBird\RecentSearch;

$params = [
    'query' => 'dancing has:images ',
    'tweet.fields' => 'attachments,author_id,created_at',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
    'max_results'  => 10,

];

$search = new RecentSearch;
$result = $search->RecentSearchRequest($params);
$media = $result->includes->media;

```

Lookup details about multiple tweets by Id - if a single id is provided Elephant Bird will choose the single tweet endpoint:

```php
use Coderjerk\ElephantBird\TweetLookup;

$ids = [
    '1261326399320715264',
    '1278347468690915330'
];

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$lookup = new TweetLookup;
$tweets = $lookup->getTweetsById($ids, $params);
```

Lookup a single user by username:

```php
use Coderjerk\ElephantBird\UserLookup;

$params = [
    'user.fields' => 'id'
];

$usernames = [
    'coderjerk'
];

$userLookup = new UserLookup;
$user = $userLookup->lookupUsersByUsername($usernames, $params);

```

Lookup multiple users by id:

```php
use Coderjerk\ElephantBird\UserLookup;

$ids = [
    '802448659',
    '16298441'
];

$userLookup = new UserLookup;
$user = $userLookup->lookupUsersById($ids, $params);
```

## Contributing

This package is in the early stages of development. Issues, pull requests and other contributions most welcome.
You can [look at the project board here for features to work on:](https://github.com/danieldevine/elephant-bird/projects/1)
