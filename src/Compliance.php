<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Compliance\BatchCompliance;

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
    public function createJob($type, $name, $resumable = false)
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
    public function getJob($id)
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
    public function getJobs($type)
    {
        $batch_compliance = new BatchCompliance($this->credentials);
        return $batch_compliance->getComplianceJobs($type);
    }
}
