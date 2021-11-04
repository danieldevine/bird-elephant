Search for media:

```php
use Coderjerk\BirdElephant\RecentSearch;

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

Lookup details about multiple tweets by Id - if a single id is provided Bird Elephantwill choose the single tweet endpoint:

```php
use Coderjerk\BirdElephant\Tweets\TweetLookup;

$ids = [
    '1261326399320715264',
    '1278347468690915330'
];

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$lookup = new TweetLookup($credentials);
$tweets = $lookup->getTweetsById($ids, $params);
```
#### Timeline

Get a given user's Tweets.

```php
use Coderjerk\BirdElephant\TimeLine;

$timeline = new TimeLine;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$tweets = $timeline->getTweets('802448659', $params);

```

Get a given user's mentions.

```php
use Coderjerk\BirdElephant\TimeLine;

$timeline = new TimeLine;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$mentions = $timeline->getMentions('802448659', $params);
```

```php
$recent = $twitter->tweets()->counts($params = ['query' => 'test'])->recent();
dump($recent);

$tweet = $twitter->tweets()->lookup()->getTweet('1278347468690915330');

$tweets = $twitter->tweets()->lookup()->getTweets(['1261326399320715264', '1278347468690915330']);
dump($tweets);

$timeline = $twitter->tweets()->timeline(['tweet.fields' => 'conversation_id'])->getTweets('coderjerk');
dump($timeline);

$search = $twitter->tweets()->search($params = ['query' => 'conversation_id:1455187677326757899'])->recent();
dump($search);

// //note: you can't hide your own replies!!
$hide = $twitter->tweets()->reply()->hide('1455193907352965127');
dump($hide);

// get likers of a tweet
$likers = $twitter->tweets()->likes($params = [])->likingUsers('1450110343137665036');
dump($likers);

$like = $twitter->user('coderjerk')->likes();
dump($like);

$likers = $twitter->tweets()->retweets($params = [])->retweetedBy('1450110343137665036');
dump($likers);
```
