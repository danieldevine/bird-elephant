# Spaces

Spaces allow expression and interaction via live audio conversation. These endpoints seem to very much be in their infancy at the moment, so expect some changes here as the Twitter API v2 matures.

### Methods

#### `lookup()->getSpace()`
Lookup a space by id
###### Auth: OAuth 2.0 Bearer token
| Argument  | Type   | Description                                    |          |
|-----------|--------|------------------------------------------------|----------|
| $space_id | String | The Space Id                                   | required |
| $params   | Array  | see Twitter docs for avilable query parameters | optional |

#### `lookup()->getSpaces()`
Look up multiple spaces by id
###### Auth: OAuth 2.0 Bearer token
| Argument   | Type  | Description                                    |          |
|------------|-------|------------------------------------------------|----------|
| $space_ids | Array | The Space Ids                                  | required |
| $params    | Array | see Twitter docs for avilable query parameters | optional |


#### `lookup()->discover()`
lookup live or scheduled Spaces created by the specified user IDs
###### Auth: OAuth 2.0 Bearer token
| Argument  | Type  | Description                                    |          |
|-----------|-------|------------------------------------------------|----------|
| $creator_ids | Array | Creator user Ids                                       | required |
| $params   | Array | See Twitter docs for avilable query parameters | optional |


### Reference
- [Spaces](https://developer.twitter.com/en/docs/twitter-api/spaces/overview)
- [Twitter API Spaces Lookup Reference](https://developer.twitter.com/en/docs/twitter-api/spaces/lookup/api-reference)
- [Twitter API Search Spaces Reference](https://developer.twitter.com/en/docs/twitter-api/spaces/search/api-reference/get-spaces-search)


### Examples

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant($credentials);

//lookup a space by space id

$params = [
    'space.fields' => 'creator_id, id,  invited_user_ids, participant_count, speaker_ids',
    'user.fields' => 'description, entities, id, location, name, pinned_tweet_id, profile_image_url'
]

$space = $twitter->spaces()->lookup()->getspace($space_id, $params);

// lookup multiple spaces by id
$space_ids = [
    $space_id_1,
    $space_id_2
];

$spaces = $twitter->spaces()->lookup()->getspaces($space_ids, $params);

// lookup live or scheduled Spaces created by the specified user IDs
$creator_ids = [
    $creator_id_1,
    $creator_id_1
];

$spaces = $twitter->spaces()->lookup()->discover($creator_ids, $params);
```
