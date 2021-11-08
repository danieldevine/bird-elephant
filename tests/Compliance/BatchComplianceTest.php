<?php

namespace Compliance;


use Coderjerk\BirdElephant\Compliance\BatchCompliance;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertObjectHasAttribute;

class BatchComplianceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = array(
            'bearer_token' => $_ENV['TWITTER_BEARER_TOKEN'],
            'consumer_key' => $_ENV['TWITTER_API_KEY'],
            'consumer_secret' => $_ENV['TWITTER_SECRET'],
            'token_identifier' => $_ENV['TWITTER_ACCESS_TOKEN'],
            'token_secret' => $_ENV['TWITTER_ACCESS_TOKEN_SECRET'],
        );
    }


    public function testCreateComplianceJob()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);

        $job = $batch->createComplianceJob('tweets', $name, false);
        self::assertObjectHasAttribute('type', $job->data);

    }

    public function testGetComplianceJobs()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);

        $jobs = $batch->getComplianceJobs('tweets');
        self::assertObjectHasAttribute('type', $jobs->data);

    }

    public function testGetComplianceJob()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);
        $jobs = $batch->getComplianceJobs('tweets');
        $id = $jobs[0]->data->id;
        $job = $batch->getComplianceJob($id);
        self::assertIsString($id);
    }
}
