
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
use Coderjerk\ElephantBird\Follows;

$follows = new Follows;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$followers = $follows->getFollowers('coderjerk', $params);

```

Get Following

```php
use Coderjerk\ElephantBird\Follows;

$follows = new Follows;

$params = [
    'tweet.fields' => 'attachments,author_id,created_at,public_metrics,source'
];

$following = $follows->getFollowing('coderjerk', $params);

//follow a user by handle - the first handle must be the authorised user
$follow = $twitter->user('coderjerk')->follow('claydermanmusic');

//unfollow a user by handle - the first handle must be the authorised user. not actually working despite returning the correct response. Reported to Twitter
$unfollow = $twitter->user('coderjerk')->unfollow('claydermanmusic');

```

## Blocks

```php
//block a user by handle - the first handle must be the authorised user
$block = $twitter->user('coderjerk')->block('claydermanmusic');

//unblock a user by handle -the first handle must be the authorised user
$unblock = $twitter->user('coderjerk')->unblock('claydermanmusic');

//list all blocks - user must be the authorised user
$blocks = $twitter->user('coderjerk')->blocks();
```
```php

$following = $twitter->user('coderjerk')->following([
    //add some query parameters
    'max_results' => 20,
    'user.fields' => 'profile_image_url'
]);

echo "Following Count: {$following->meta->result_count} ";
echo "Next Token: {$following->meta->next_token}";

foreach ($following->data as $follower) {
    echo "<div>";
    echo "<img src='{$follower->profile_image_url}' alt='{$follower->name}'/>";
    echo "<h3>{$follower->name}</h3>";
    echo "</div>";
}

//follow a user by handle - the first handle must be the authorised user
$follow = $twitter->user('coderjerk')->follow('jack');
dump($follow);

// //unfollow a user by handle - the first handle must be the authorised user
$unfollow = $twitter->user('coderjerk')->unfollow('jack');
dump($unfollow);

//Mute a user by handle - the first handle must be the authorised user
$mute = $twitter->user('coderjerk')->follow('jack');
dump($mute);
```
