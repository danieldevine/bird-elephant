# Compliance

Compliance endpoints allow you to upload large datasets of Tweet or user IDs to retrieve their compliance status.

### Methods

#### `createJob()`
Create a new compliance job
###### Auth: OAuth 2.0 Bearer token

 | Argument | Type   | Description                      |          |
 |----------|--------|----------------------------------|----------|
 | $type     | string | can be either 'tweets' or 'users | required |
 | $name     | string | a name for this job              | optional |
 | $resumable| bool   | whether to enable the upload URL with support for resumable uploads. Defaults to false.| optional


#### `getJob()`
Get a single compliance job with a specified ID
###### Auth: OAuth 2.0 Bearer token

 | Argument  | Type   | Description                         |          |
 |-----------|--------|-------------------------------------|----------|
 | $type      | string | can be either 'tweets' or 'users    | required |


#### `getJobs()`
Get a list of compliance jobs of a given type
###### Auth: OAuth 2.0 Bearer token

 | Argument  | Type   | Description                        |          |
 |-----------|--------|------------------------------------|----------|
 | $type      | string | can be either 'tweets' or 'users   | required |

### Reference
Refer to the Twitter documentation for details of paramaters, expansions and fields.
- [Twitter Api Compliance reference](https://developer.twitter.com/en/docs/twitter-api/compliance/batch-compliance/api-reference)

### Examples

```php
use Coderjerk\BirdElephant\BirdElephant;

$twitter = new BirdElephant($credentials);

// create a new compliance job
$new_job = $twitter->compliance()->createJob($type = 'tweets', $name = 'test', $resumable = false);

// get jobs of the type 'tweets'
$jobs = $twitter->compliance()->getJobs('tweets');

// loop through the response and get ids
foreach ($jobs->data as $job) {
    $job = $twitter->compliance()->getJob($job->id);
}
```
