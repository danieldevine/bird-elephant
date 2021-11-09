<?php
namespace Coderjerk\Tests;

use Coderjerk\BirdElephant\Compliance\BatchCompliance;
use Coderjerk\Tests\BaseTest;
use GuzzleHttp\Exception\GuzzleException;


class BatchComplianceTest extends BaseTest
{
    private array $credentials;

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = $this->setUpCredentials();

    }

    /**
     * @throws GuzzleException
     */
    public function testCreateComplianceJob()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);

        $job = $batch->createComplianceJob('tweets', $name, false);
        self::assertIsObject($job);

    }

    /**
     * @throws GuzzleException
     */
    public function testGetComplianceJobs()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);

        $jobs = $batch->getComplianceJobs('tweets');
        self::assertObjectHasAttribute('type', $jobs->data[0]);

    }

    /**
     * @throws GuzzleException
     */
    public function testGetComplianceJob()
    {
        $batch = new BatchCompliance($this->credentials);

        $name = substr(md5(mt_rand()), 0, 7);
        $jobs = $batch->getComplianceJobs('tweets');
        $id = $jobs->data[0]->id;
        $job = $batch->getComplianceJob($id);
        self::assertIsString($id);
    }
}
