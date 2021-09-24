<?php

namespace Coderjerk\ElephantBird;

use Coderjerk\ElephantBird\Request;

/**
 * Filters the real-time stream
 * of public Tweets.
 *
 * @author Dan Devine <jerk@coderjerk.com>
 */
class FilteredStream
{
    /**
     * endpoint
     *
     * @var string
     */
    public $uri = 'tweets/search/stream';

    /**
     * Connects to filtered stream
     *
     * @param array $params
     * @return object
     */
    public function connectToStream($params)
    {
        $request = new Request;
        return $request->makeRequest('GET', $this->uri, $params, null, true);
    }

    /**
     * Gets filtered stream rules
     *
     * @return object
     */
    public function getRules()
    {
        $uri = $this->uri . '/rules';
        $params = [];

        $request = new Request;
        return $request->makeRequest('GET', $uri, $params);
    }

    /**
     * Sets one or more filtered stream rules
     *
     * @param string $value
     * @param string $tag
     * @return object
     */
    public function setRules($value, $tag)
    {
        $uri = $this->uri . '/rules';

        $rules =  [
            [
                'value' => $value,
                'tag' => $tag,
            ]
        ];

        $params = [];
        $data = ['add' => $rules];

        $request = new Request;
        return $request->makeRequest('POST', $uri, $params, $data);
    }

    /**
     * deletes a single filtered stream rule
     * identified by id
     *
     * @param string $id
     * @return object
     */
    public function deleteRule($id)
    {
        $uri = $this->uri . '/rules';

        $rules =  [
            'ids' => [
                $id
            ]
        ];

        $params = [];
        $data = ['delete' => $rules];

        $request = new Request;
        return $request->makeRequest('POST', $uri, $params, $data);
    }

    /**
     * Deletes all filtered stream rules
     *
     * @return Object
     */
    public function deleteAllRules()
    {
        $rules = $this->getRules();

        if ($rules && property_exists($rules, 'data')) {
            foreach ($rules->data as $rule) {
                $this->deleteRule($rule->id);
            }
        } else {
            return 'No rules to delete';
        }
    }
}
