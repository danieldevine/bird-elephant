# Users

### Methods

#### `followers()`
Gets a Twitter user's followers
###### Auth: OAuth 2.0 Bearer token

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `following()`
Gets a Twitter user's followed accounts
###### Auth: OAuth 2.0 Bearer token
| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `follow()`
Follows a given user
###### Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $target_username | String| The target twitter username            | required |

#### `unfollow()`
Unfollows a given user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |

#### `blocks()`
Gets the blocked accounts of a Twitter user.
###### Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `block()`
Blocks a given user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |

#### `unblock()`
Unblocks a given user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |

#### `mutes()`
Gets the muted accounts of a Twitter user.
###### Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `mute()`
Mutes a given user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |

#### `unmute()`
Unmutes a given user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_username | String| The target twitter username | required |

#### `likes()`
Gets the named user's last 100 likes
###### Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |

#### `like()`
Likes a tweet on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $tweet_id  | String | the target tweet id | optional |


#### `unlike()`
Unlikes a tweet on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | optional |


#### `retweet()`
Retweets a tweet on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | optional |


#### `unretweet()`
Unretweets a tweet on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument  | Type   | Description         |          |
|-----------|--------|---------------------|----------|
| $tweet_id | String | the target tweet id | optional |


#### `spaces()`
Gets a user's spaces
###### Auth: OAuth 2.0 Bearer token

| Argument | Type  | Description                                    |          |
|----------|-------|------------------------------------------------|----------|
| $params  | Array | see Twitter docs for avilable query parameters | optional |


#### `lists()->follow()`
Follows a list on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument         | Type  | Description                 |          |
|------------------|-------|-----------------------------|----------|
| $target_list_id | String | The target list id           | required |

#### `lists()->unfollow()`
Unfollows a list on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument        | Type  | Description        |          |
|-----------------|-------|--------------------|----------|
| $target_list_id | String | The target list id | required |

#### `lists()->pin()`
Unpins a list on behalf of the authenticated user
###### Auth: OAuth 1.0a User context

| Argument        | Type  | Description        |          |
|-----------------|-------|--------------------|----------|
| $target_list_id | String | The target list id | required |

#### `lists()->unpin()`
Pins a list on behalf of the authenticated user
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

### Examples

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant;

$user = $twitter->user($user_name);

// get a user's followers
$user->followers();

// get accounts that a user follows
$user->following();

// get a user's likes
$user->likes();

// do the same thing but with some params - check the Twitter reference above for all available params
$user->following([
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

// follow an account on behalf of a named user, needs to be the currently authenticated user.
$user->follow('coderjerk');

//..and unfollow an account
$user->unfollow('barrymanilow');

// see blocked accounts on behalf of the currently authenticated user
$user->blocks();

// block a user
$user->block('GilbertOSull_');

// unblock a user
$user->unblock('claydermanmusic');

// mute a user
$user->mute('kennyg');

// unmute a user
$user->unmute('kennyg');

// follow a list on behalf of the named user
$user->lists()->follow($list_id);

// unfollow a list
$user->lists()->unfollow($list_id);
```
