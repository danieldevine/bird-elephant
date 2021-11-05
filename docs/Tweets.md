# Tweets

### The `tweets()` Method

```php
$twitter = new BirdElephant($credentials);
$tweets = $twitter->tweets();
```

#### `get()`
Gets a tweet

```php
$tweets->get($id, $params);
```
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |
| $params | Array  | Query Parameters | optional |

#### `lookup()`
Gets multiple tweets
```php
$tweets->lookup([$id1,$id2], $params);
```
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $ids    | Array | The Tweet ids     | required |
| $params | Array  | Query Parameters | optional |

#### `count()->recent()`
Gets  a count of Tweets that match a query in the last 7 days.
```php
$tweets->count->recent($params);
```
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |

#### `count()->all()`
Gets a count of Tweets that match a query. Academic track only.
```php
$tweets->count->all($params);
```
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |

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
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |

#### `search()->all()`
Search Tweets that match a query. Academic track only.
```php
$tweets->search->all($params);
```
| Name    | Type  | Description      |          |
|---------|-------|------------------|----------|
| $params | Array | Query Parameters | required |

#### `reply()->hide()`
Hide a reply to a tweet
```php
$tweets->reply->hide($id);
```
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |

#### `reply()->unhide()`
unhide a reply to a tweeet
```php
$tweets->reply->unhide($id);
```
| Name | Type   | Description  |          |
|------|--------|--------------|----------|
| $id  | String | The Tweet id | required |

#### `likers()`
Get the users who have liked a given tweet
```php
$tweets->likers($id, $params);
```
| Name    | Type   | Description      |          |
|---------|--------|------------------|----------|
| $id     | String | The Tweet id     | required |
| $params | Array  | Query Parameters | optional |


