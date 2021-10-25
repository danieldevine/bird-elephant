#### Compliance example

```php
$compliance = $twitter->compliance();

$new_job = $compliance->createJob('tweets', 'test', false);

$jobs = $compliance->getJobs('tweets');

foreach ($jobs->data as $job) {
    $job = $compliance->getJob($job->id);
}
```
