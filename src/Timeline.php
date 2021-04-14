<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Access Tweets published by a
 * specific Twitter account.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 * @since 1.5.0
 */
class Timeline
{
    /**
     * The endpoint
     *
     * @var string
     */
    public $uri = 'users';

    public $default_params = [
        'max_results' => 10
    ];

    public function getTweets($id, $params)
    {
        return $this->getTimeline($id, $params, '/tweets');
    }

    public function getMentions($id, $params)
    {
        return $this->getTimeline($id, $params, '/mentions');
    }

    protected function getTimeline($id, $params, $endpoint)
    {
        $path = $this->uri . '/' .  $id . $endpoint;

        $params = array_merge($this->default_params, $params);

        $request = new Request();
        return $request->makeRequest('GET', $path, $params);
    }
}
