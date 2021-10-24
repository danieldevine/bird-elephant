<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;
use Coderjerk\ElephantBird\Compliance\BatchCompliance;

$twitter = new ElephantBird;

//users example
$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();

//compliance example
$compliance = $twitter->compliance();

$new_job = $compliance->createJob('tweets', 'test', false);

$jobs = $compliance->getJobs('tweets');

foreach ($jobs->data as $job) {
    $job = $compliance->getJob($job->id);
}
