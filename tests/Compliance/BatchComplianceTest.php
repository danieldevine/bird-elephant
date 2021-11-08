<?php

namespace Compliance;


use Coderjerk\BirdElephant\Compliance\BatchCompliance;
use PHPUnit\Framework\TestCase;

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

        $job = $batch->createComplianceJob('tweets', 'test', false);
    }

    public function testGetComplianceJobs()
    {
    }

    public function testGetComplianceJob()
    {
    }
}
