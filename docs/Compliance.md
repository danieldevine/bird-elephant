## Compliance

Compliance endpoints allow you to upload large datasets of Tweet or user IDs to retrieve their compliance status.

- [Batch Compliance](https://developer.twitter.com/en/docs/twitter-api/compliance/batch-compliance/introduction)
- [Twitter Api Compliance reference](https://developer.twitter.com/en/docs/twitter-api/compliance/batch-compliance/api-reference)

#### Examples

```php
use Coderjerk\ElephantBird\ElephantBird;

$twitter = new ElephantBird($credentials);

//Create a new compliance job
$new_job = $twitter->compliance()->createJob($type = 'tweets', $name = 'test', $resumable = false);

// get jobs of the type 'tweets'
$jobs = $twitter->compliance()->getJobs('tweets');

//loop through the response and get ids
foreach ($jobs->data as $job) {
    $job = $twitter->compliance()->getJob($job->id);
}
```
#### createJob()
Create a new compliance job

 | Argument | Type   | Description                      |          |
 |----------|--------|----------------------------------|----------|
 | $type     | string | can be either 'tweets' or 'users | required |
 | $name     | string | a name for this job              | optional |
 | $resumable| bool   | whether to enable the upload URL with support for resumable uploads. Defaults to false.| optional


#### getJob()
Get a single compliance job with a specified ID

 | Argument  | Type   | Description                         |          |
 |-----------|--------|-------------------------------------|----------|
 | $type      | string | can be either 'tweets' or 'users    | required |


#### getJobs()
Get a list of compliance jobs of a given type

 | Argument  | Type   | Description                        |          |
 |-----------|--------|------------------------------------|----------|
 | $type      | string | can be either 'tweets' or 'users   | required |
