# Tweets

Documentation in progress - here are some quick examples in the meantime:

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant;

$tweets = $twitter->tweets();

$tweets->counts($params = ['query' => 'test'])->recent();

$tweets->lookup()->getTweet('1278347468690915330');

$tweets->lookup()->getTweets(['1261326399320715264', '1278347468690915330']);

$tweets->timeline(['tweet.fields' => 'conversation_id'])->getTweets('coderjerk');

$tweets->search($params = ['query' => 'conversation_id:1455187677326757899'])->recent();

$params = [
    'query' => 'limerick has:images ',
    'tweet.fields' => 'attachments,author_id,created_at',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
    'max_results'  => 5,
];
$search = $tweets->search($params)->recent();

// //note: you can't hide your own replies!!
$tweets->reply()->hide('1455193907352965127');

// get likers of a tweet
$tweets->likes($params = [])->likingUsers('1450110343137665036');

$tweets->retweets($params = [])->retweetedBy('1450110343137665036');

```
Full documentation to follow shortly.


## Tweet Lookup

#### `lookup()`
#### `counts()`
#### `search()`
#### `timeline()`
#### `reply()`
#### `likes()`
#### `retweets()`
