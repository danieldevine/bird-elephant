<?php

namespace Coderjerk\BirdElephant;

use Coderjerk\BirdElephant\Compliance\BatchCompliance;

class Compliance
{

    protected array $credentials;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Creates a new compliance job
     *
     * @param string $type 'tweets' | 'users
     * @param string $name
     * @param boolean $resumable
     * @return object
     */
    public function createJob(string $type, string $name, bool $resumable): object
    {
        $batch_compliance = new BatchCompliance($this->credentials);
        return $batch_compliance->createComplianceJob($type, $name, $resumable);
    }

    /**
     * Get a single compliance job with a specified ID.
     *
     * @param string $id
     * @return object
     */
    public function getJob(string $id): object
    {
        $batch_compliance = new BatchCompliance($this->credentials);
        return $batch_compliance->getComplianceJob($id);
    }

    /**
     * Gets a list of compliance jobs of a given type
     *
     * @param string $type 'tweets' | 'users'
     * @return object
     */
    public function getJobs(string $type): object
    {
        $batch_compliance = new BatchCompliance($this->credentials);
        return $batch_compliance->getComplianceJobs($type);
    }
}
