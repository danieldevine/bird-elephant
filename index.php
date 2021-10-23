<?php
require_once('bootstrap.php');

use Coderjerk\ElephantBird\ElephantBird;
use Coderjerk\ElephantBird\Compliance\BatchCompliance;

$twitter = new ElephantBird;

$user = $twitter->user('coderjerk');

$followers = $user->followers();
$following = $user->following();

$batch_compliance = new BatchCompliance();

$compliance = $batch_compliance->createComplianceJob('tweets', 'test', false);

dump($compliance);

$batch_compliance = new BatchCompliance();

$jobs =  $batch_compliance->getComplianceJobs('tweets');

dump($jobs);


?>

<pre>
    use Coderjerk\ElephantBird\ElephantBird;

    $twitter = new ElephantBird;

    $user = $twitter->user('coderjerk');

    $followers = $user->followers();
    $following = $user->following();
</pre>
