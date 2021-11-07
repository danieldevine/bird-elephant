# Users

### The `users()` Method
Retrieves information about multiple Twitter users.

#### `lookup()`
Looks up multiple twitter users by username
```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant($credentials);

$usernames = ['coderjerk', 'kennyg', 'dril'];

$params = [
    'expansions' => 'pinned_tweet_id',
    'user.fields' =>  'created_at,description,entities,id,location'
];

$users = $twitter->users()->lookup($usernames, $params);
```
###### Auth: OAuth 2.0 Bearer token
| Argument    | Type  | Description                                    |          |
|-------------|-------|------------------------------------------------|----------|
| $usernames  | Array | array of Twitter usernames | required |
| $params     | Array | [available query parameters](https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-by-username-username) | optional |
---

# User

### The `user()` Method
Sets up a Twitter user by user name to be used in conjunction with the methods below to perform actions on behalf of and retrieve data about the named user. The named user must be the authenticated user in instances where user context auth is required.

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant($credentials);
$user = $twitter->user($user_name);
```
###### Auth: OAuth 2.0 Bearer token
| Argument   | Type   | Description                                    |          |
|------------|--------|------------------------------------------------|----------|
| $user_name | String | Twitter username                               | required |

#### `get()`
Gets information about the named Twitter user.

```php
$user->get();
```
###### Auth: OAuth 2.0 Bearer token
| Argument   | Type   | Description                                    |          |
|------------|--------|------------------------------------------------|----------|
| $params    | Array  | [available query parameters](https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference/get-users-id) | optional |

---

#### `followers()`
Gets a Twitter user's followers

```php
$user->followers();
```
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | [available query parameters](https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference) | optional |
---
#### `following()`
Gets a Twitter user's followed accounts
```php
$params= [
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
];
$user->following($params);
```
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | [available query parameters](https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference) | optional |
---
#### `follow()`
Follows a given user
###### Auth: OAuth 1.0a User context
```php
$user->follow('coderjerk');
```
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $target_username | String| The target twitter username            | required |
---
#### `unfollow()`
Unfollows a given user
```php
$user->unfollow('barrymanilow');
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |
---
#### `tweets()`
Gets the tweets of a Twitter user.
```php
$user->tweets();
```
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |
---
#### `mentions()`
Gets the mentions of a Twitter user.
```php
$user->mentions();
```
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

---
#### `blocks()`
Gets the blocked accounts of a Twitter user.

```php
$user->blocks();
```
###### Auth: OAuth 1.0a User context
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |
---
#### `block()`
Blocks a given user
```php
$user->block('GilbertOSull_');
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |
---
#### `unblock()`
Unblocks a given user
```php
$user->unblock('claydermanmusic');
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |
---
#### `mutes()`
Gets the muted accounts of a Twitter user.
```php
$user->mutes();
```
###### Auth: OAuth 1.0a User context
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |
---
#### `mute()`
Mutes a given user
```php
$user->mute('kennyg');
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |
---
#### `unmute()`
Unmutes a given user
```php
$user->unmute('kennyg');
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |
---
#### `likes()`
Gets the named user's last 100 likes
```php
$user->likes($params);
```
###### Auth: OAuth 1.0a User context
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |
---
#### `like()`
Likes a tweet on behalf of the authenticated user
```php
$user->like('1456978214837006343');
```
###### Auth: OAuth 1.0a User context
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $tweet_id  | String | the target tweet id | reqired |
---

#### `unlike()`
Unlikes a tweet on behalf of the authenticated user
```php
$user->unlike($tweet_id);
```
###### Auth: OAuth 1.0a User context
| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | required |

---
#### `retweet()`
Retweets a tweet on behalf of the authenticated user
```php
$user->retweet('1456978214837006343');
```
###### Auth: OAuth 1.0a User context
| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | required |
---
#### `unretweet()`
Unretweets a tweet on behalf of the authenticated user
```php
$user->unretweet($tweet_id);
```
###### Auth: OAuth 1.0a User context
| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | required |
---
#### `spaces()`
Gets a user's spaces
```php
$user->spaces();
```
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |
---

#### `lists()->follow()`
Follows a list on behalf of the authenticated user
```php
$user->lists()->follow($target_list_id);
```
###### Auth: OAuth 1.0a User context
| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_list_id | String | The target list id           | required |
---
#### `lists()->unfollow()`
Unfollows a list on behalf of the authenticated user
```php
$user->lists()->unfollow($target_list_id);
```
###### Auth: OAuth 1.0a User context
| Argument        | Type  | Description        |          |
|-----------------|-------|--------------------|----------|
| $target_list_id | String | The target list id | required |
---
#### `lists()->pin()`
Unpins a list on behalf of the authenticated user
```php
$user->lists()->pin($target_list_id);
```
###### Auth: OAuth 1.0a User context
| Argument        | Type  | Description        |          |
|-----------------|-------|--------------------|----------|
| $target_list_id | String | The target list id | required |
---
#### `lists()->unpin()`
Pins a list on behalf of the authenticated user
```php
$user->lists()->unpin($target_list_id);
```
###### Auth: OAuth 1.0a User context
| Argument        | Type  | Description        |          |
|-----------------|-------|--------------------|----------|
| $target_list_id | String | The target list id | required |

### Reference
Refer to the Twitter documentation for details of paramaters, expansions and fields.
- [User Lookup](https://developer.twitter.com/en/docs/twitter-api/users/lookup/api-reference)
- [Follows](https://developer.twitter.com/en/docs/twitter-api/users/follows/api-reference)
- [Blocks](https://developer.twitter.com/en/docs/twitter-api/users/blocks/api-reference)
- [Mutes](https://developer.twitter.com/en/docs/twitter-api/users/mutes/api-reference)
