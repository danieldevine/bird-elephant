# Spaces

Spaces allow expression and interaction via live audio conversation. These endpoints seem to very much be in their infancy at the moment, so expect some changes here as the Twitter API v2 matures.

- [Spaces](https://developer.twitter.com/en/docs/twitter-api/spaces/overview)
- [Twitter API Spaces Lookup Reference](https://developer.twitter.com/en/docs/twitter-api/spaces/lookup/api-reference)
- [Twitter API Search Spaces Reference](https://developer.twitter.com/en/docs/twitter-api/spaces/search/api-reference/get-spaces-search)

## Spaces Lookup

### Examples

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant($credentials);

//lookup a space by space id
$space = $twitter->spaces()->lookup()->getspace($space_id, $params);


// lookup multiple spaces by id

//array of space ids
$space_ids = [
    $space_id_1,
    $space_id_2
];

$spaces = $twitter->spaces()->lookup()->getspaces($space_ids, $params);

// lookup live or scheduled Spaces created by the specified user IDs

//array of user ids
$user_ids = [
    $user_id_1,
    $user_id_1
];

$spaces = $twitter->spaces()->lookup()->discover($user_ids, $params);
```

## Search Spaces

Coming soon.
