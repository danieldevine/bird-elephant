# Users

Documentation in progress - here are some quick examples in the meantime:

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

// see what accounts you've blocked (on behalf of the currently authenticated user only)
$user->blocks();

// block a user
$user->block('GilbertOSull_');

// unblock a user
$user->unblock('claydermanmusic');

// mute a user by handle - the first handle must be the authorised user
$user->mute('kennyg');

// unmute a user
$user->unmute('kennyg');

// follow a list on behalf of the named user
$user->lists()->follow($list_id);

// unfollow a list
$user->lists()->unfollow($list_id);
```

Proper method documentation to follow shortly.
