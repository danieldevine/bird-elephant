
```php
use Coderjerk\ElephantBird\ElephantBird;

$twitter = new ElephantBird;

$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();

```
#### User Lookup

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
#### Follows Lookup

Get Followers

```php
use Coderjerk\ElephantBird\FollowsLookup;

$follows = new FollowsLookup;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$followers = $follows->getFollowers('coderjerk', $params);

```

Get Following

```php
use Coderjerk\ElephantBird\FollowsLookup;

$follows = new FollowsLookup;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$following = $follows->getFollowing('coderjerk', $params);
```
