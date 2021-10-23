<?php

namespace Coderjerk\ElephantBird\Compliance;

use Coderjerk\ElephantBird\Request;


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
    public $uri = 'compliance/jobs';


    /**
     * Creates a new compliance job for Tweet IDs or user IDs.
     *
     * I'm not planing on handling the rest of the compliance process beyond this,
     * as I feel its out of scope for this library, but I'll accept pull requests
     * if its something that people want.
     *
     * @return object
     */
    public function createComplianceJob($type, $name, $resumable = false)
    {
        $params = [
            'type' => $type,
            'name' => $name,
            'resumable' => $resumable
        ];

        $request = new Request;

        return $request->bearerTokenRequest('POST', $this->uri, null, $params, false);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getComplianceJob($id)
    {
    }

    /**
     * Undocumented function
     *
     * @return object
     */
    public function getComplianceJobs($type)
    {
        $params = [
            'type' => $type,
        ];

        $request = new Request;

        return $request->bearerTokenRequest('GET', $this->uri, $params, null, false);
    }
}
