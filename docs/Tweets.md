[Twitter Recent Search Endpoint API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent)

### Recent Search

Search the 14 most recent tweets relating to football.

```php
use Coderjerk\ElephantBird\RecentSearch;

$params = [
    'query'        => 'php',
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
    'query' => 'limerick has:images ',
    'tweet.fields' => 'attachments,author_id,created_at',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
    'max_results'  => 10,
];

$search = new RecentSearch;
$result = $search->RecentSearchRequest($params);
$media = $result->includes->media;

```

#### Tweet Lookup

[Lookup Multiple Tweets API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets)

[Lookup Single Tweets API Reference](https://developer.twitter.com/en/docs/twitter-api/tweets/lookup/api-reference/get-tweets-id)

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
#### Timeline

Get a given user's Tweets.

```php
use Coderjerk\ElephantBird\TimeLine;

$timeline = new TimeLine;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$tweets = $timeline->getTweets('802448659', $params);

```

Get a given user's mentions.

```php
use Coderjerk\ElephantBird\TimeLine;

$timeline = new TimeLine;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$mentions = $timeline->getMentions('802448659', $params);

```
