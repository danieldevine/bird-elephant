<?php

namespace Coderjerk\ElephantBird\Compliance;

/**
 * Tool endpoints to help maintain Twitter data in compliance
 * with the Twitter Developer Agreement and Policy.
 *
 */
class BatchCompliance
{
    /**
     * endpoint
     *
     * @var string
     */
    public $uri = 'tweets/compliance/jobs';

    /**
     * Specify whether you will be uploading tweet or user IDs.
     * You can either specify tweets or users.
     *
     * @var string users | tweets
     */
    public $type = 'tweets';

    /**
     * A name for this job.
     *
     * @var string
     */
    public $name = '';

    /**
     * Specifies whether to enable the upload URL with support for resumable uploads.
     * If true, this endpoint will return a pre-signed URL with resumable uploads enabled.
     *
     * @var boolean
     */
    public $resumable = false;

    /**
     * Undocumented function
     *
     * @return void
     */
    public function createComplianceJob()
    {
    }

    public function getComplianceJob()
    {
    }
}
