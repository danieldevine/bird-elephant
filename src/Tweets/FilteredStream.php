<?php

namespace Coderjerk\BirdElephant\Tweets;

use Coderjerk\BirdElephant\ApiBase;
use Coderjerk\BirdElephant\Request;

/**
 * Filters the real-time stream
 * of public Tweets.
 *
 * @author Dan Devine <dandevine0@gmail.com>
 */
class FilteredStream extends ApiBase
{
    /**
     * endpoint
     *
     * @var string
     */
    public $uri = 'tweets/search/stream';


    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Connects to filtered stream
     *
     * @param array $params
     * @return object
     */
    public function connectToStream($params)
    {
        return $this->get($this->credentials, $this->uri, $params, null, true);
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

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('GET', $uri, $params);
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

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('POST', $uri, $params, $data);
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

        $request = new Request($this->credentials);
        return $request->bearerTokenRequest('POST', $uri, $params, $data);
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
