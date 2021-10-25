
```php
use Coderjerk\ElephantBird\ElephantBird;

$twitter = new ElephantBird;

$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();

```
