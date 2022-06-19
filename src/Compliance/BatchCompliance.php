<?php

namespace Coderjerk\BirdElephant\Compliance;

use Coderjerk\BirdElephant\Request;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Endpoints to help maintain Twitter data in compliance
 * with the Twitter Developer Agreement and Policy.
 *
 */
class BatchCompliance
{
    /**
     * The endpoint
     *
     * @var string
     */
    public string $uri = 'compliance/jobs';
    private array $credentials;


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Creates a new compliance job for Tweet IDs or user IDs
     *
     * @param string $type 'tweets' | 'users
     * @param string $name
     * @param boolean $resumable
     * @return object
     * @throws GuzzleException
     */
    public function createComplianceJob(string $type, string $name, bool $resumable): object
    {
        $params = [
            'type' => $type,
            'name' => $name,
            'resumable' => $resumable
        ];

        $request = new Request($this->credentials);

        return $request->authorisedRequest('POST', $this->uri, null, $params, false);
    }

    /**
     * Gets a single compliance job by ID.
     *
     * @param string $id
     * @return object
     * @throws GuzzleException
     */
    public function getComplianceJob(string $id): object
    {
        $request = new Request($this->credentials);

        return $request->authorisedRequest('GET', $this->uri . '/' . $id, null, null, false);
    }

    /**
     * Gets a list of compliance jobs of a given type
     *
     * @param string $type 'tweets' | 'users'
     * @return object
     * @throws GuzzleException
     */
    public function getComplianceJobs(string $type): object
    {
        $params = [
            'type' => $type,
        ];

        $request = new Request($this->credentials);

        return $request->authorisedRequest('GET', $this->uri, $params, null, false);
    }
}
