# Tweets

### The `tweets()` Method

```php
$twitter = new BirdElephant($credentials);
$tweets = $twitter->tweets();
```

#### `tweet()`
Tweets a tweet object, with media or a poll. Can quote retweet and reply to tweets. See [Manage Tweets](/docs/ManageTweets.md) for full implementation details and examples;

```php
$twitter->tweets()->tweet($tweet);
```
###### Auth: OAuth 1.0 User Context
| Name   | Type   | Description                                                 |          |
|--------|--------|-------------------------------------------------------------|----------|
| $tweet | object | The Tweet object - see [Manage Tweets](/docs/ManageTweets.md) | required |

#### `delete()`
Deletes a tweet on behalf of the authenticated user

```php
$tweets->delete($tweet_id);
```
###### Auth: OAuth 1.0 User Context
| Name      | Type   | Description      |          |
|-----------|--------|------------------|----------|
| $tweet_id | String | The Tweet id     | required |
---

---
#### `get()`
Gets a tweet

```php
$tweets->get($id, $params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |
| $params | Array  | Query Parameters | optional |
---
#### `lookup()`
Gets multiple tweets
```php
$tweets->lookup([$id1,$id2], $params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $ids    | Array | The Tweet ids     | required |
| $params | Array  | Query Parameters | optional |
---
#### `count()->recent()`
Gets  a count of Tweets that match a query in the last 7 days.
```php
$tweets->count->recent($params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |
---
#### `count()->all()`
Gets a count of Tweets that match a query. Academic track only.
```php
$tweets->count->all($params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |
---
#### `search()->recent()`
Search Tweets that match a query in the last 7 days.
```php
$params = [
    'query' => 'limerick has:images ',
    'tweet.fields' => 'attachments,author_id,created_at',
    'expansions'   => 'attachments.media_keys',
    'media.fields' => 'public_metrics,type,url,width',
    'max_results'  => 5,
];

$tweets->search->recent($params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |
---
#### `search()->all()`
Search Tweets that match a query. Academic track only.
```php
$tweets->search->all($params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |
---
#### `reply()->hide()`
Hide a reply to a tweet
```php
// note: you can't hide your own replies!!
$tweets->reply->hide($id);
```
###### Auth: OAuth 1.0a User context
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |
---
#### `reply()->unhide()`
unhide a reply to a tweeet
```php
$tweets->reply->unhide($id);
```
###### Auth: OAuth 1.0a User context
| Name | Type   | Description  |          |
|------|--------|--------------|----------|
| $id  | String | The Tweet id | required |
---
#### `likers()`
Get the users who have liked a given tweet
```php
$tweets->likers($id, $params);
```
###### Auth: OAuth 2.0 Bearer token
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |
| $params | Array  | Query Parameters | optional |


